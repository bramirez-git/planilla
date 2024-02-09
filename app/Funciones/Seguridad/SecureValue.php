<?php
namespace App\Funciones\Seguridad;

/**
 * Yordanny Mejías V.
 * Creado: 2017-11-22
 * Modificado: 2020-02-03
 */
if(!class_exists('SecureValue')){
    /**
     * Class SecureValue
     * No permite crear objetos.<br>
     *
     */
    class SecureValue{
        /** Llave privada de seguridad NUNCA se debe publicar esta información */
        static $DEFAULT_PRIVATEKEY='$SecureValue@';
        private static $regex='/([^\.]+)\.([^\.]*)\.(.*)/';

        private function __construct(){ }

        /**
         * Convierte un valor base64 normal para ser compatible con urls
         * @param string $base64
         * @return string
         */
        static function base64_toUrl($base64){
            return str_replace(array('+','/','='),array('-','_',''),$base64);
        }

        /**
         * Convierte un valor base64 compatible con urls a su valor base64 normal
         * @param string $base64_url
         * @return string
         */
        static function base64_fromUrl($base64_url){
            $b64=str_replace(array('-','_'),array('+','/'),$base64_url);
            if((strlen($b64)%4)>0){
                $b64.=str_repeat('=', 4-(strlen($b64)%4));
            }
            return $b64;
        }

        /**
         * Genera un MD5 en base64
         * @param $data
         * @return string
         */
        static function md5_base64($data){
            return self::base64_toUrl(base64_encode(md5($data,true)));
        }

        /**
         * Genera un checksum seguro para el valor, utilizando una llave privada de codificación
         * @param string $value Valor original
         * @param string $token Token público. Se adjunta al checksum generado. Se elimina cualquier caracter '.' que contenga.
         * @param string $privatekey Llave privada. NUNCA se debe publicar esta información<br>
         * Si no es string o no se especifica, se utiliza la llave por defecto ($DEFAULT_PRIVATE_KEY)
         * @see SecureValue::$DEFAULT_PRIVATEKEY
         * @param string $subkey Opcional. Llave privada secundaria. Cambia la codificación y decodificación del valor sin modificar la llave privada.
         * @return string checksum
         */
        public static function makeCheckSum($value, $token, $privatekey=null, $subkey=''){
            if(!is_string($privatekey)) $privatekey=self::$DEFAULT_PRIVATEKEY;
            if(!is_string($subkey)) $subkey='';
            if(!is_string($value)) $value.='';
            if(!is_string($token)) $token='';
            $token=str_replace('.', '', $token);
            return self::md5_base64($privatekey.'.'.$token.'.'.$value.'.'.$token.'.'.$subkey);
        }

        /**
         * Genera un valor con checksum seguro (base64), utilizando una llave privada de codificación
         * @param string $value
         * @param string $token Token público. Se adjunta al checksum generado. Se elimina cualquier caracter '.' que contenga.<br>
         * <b>Nota:</b> <i>Puede utilizarse como una comprobación adicional, para evitar que se procese un SecureValue con un token distinto al esperado.<br>
         * Esta comprobación se realiza en la función decode()</i>
         * @param string $privatekey Opcional. Si no especifica, se utiliza la llave privada por defecto
         * @param string $subkey Opcional. Llave privada secundaria. Cambia la codificación y decodificación del valor sin modificar la llave privada.
         * @param bool $encrypt Si es TRUE, el secureValue estará encriptado
         * @return string
         * @see SecureValue::makeCheckSum()
         * @see SecureValue::decode()
         */
        static function encode($value, $token='', $privatekey=null, $subkey='', $encrypt=false){
            if(!is_string($privatekey)) $privatekey=self::$DEFAULT_PRIVATEKEY;
            if(!is_string($subkey)) $subkey='';
            if(!is_string($value)) $value.='';
            if(!is_string($token)) $token='';
            $token=str_replace('.', '', $token);
            $original_value=$value;
            if($encrypt){
                $value=self::encrypt($original_value, self::md5_base64($privatekey).'.'.self::md5_base64($subkey),$token);
            }
            $res=self::makeCheckSum($original_value.'', $token, $privatekey, $subkey).'.'.$token.'.'.$value;
            return $res;
        }

        /**
         * @param $secureValue
         * @param string $verify_token Opcional. Si se recibe un string, se comprobará que este token fue el utilizado para generar el SecureValue.
         * @param string $privatekey Opcional. Si no especifica, se utiliza la llave privada por defecto
         * @param string $subkey Opcional. Llave privada secundaria. Cambia la codificación y decodificación del valor sin modificar la llave privada.
         * @param bool $encrypt Debe ser true, si el secureValue está encriptado
         * @return string|null SecureValue si es válido.
         */
        static function decode($secureValue, $verify_token=null, $privatekey=null, $subkey='', $encrypt=false){
            if(!is_string($privatekey)) $privatekey=self::$DEFAULT_PRIVATEKEY;
            if(!is_string($subkey)) $subkey='';
            $matches=array();
            if(!preg_match(self::$regex, $secureValue, $matches)) return null;
            $matches=array(
                'CheckSum'=>&$matches[1],
                'token'=>&$matches[2],
                'value'=>&$matches[3]
            );
            if(is_string($verify_token)) $matches['token']=str_replace('.', '', $verify_token);
            if($encrypt){
                $matches['value']=self::decrypt($matches['value'], self::md5_base64($privatekey).'.'.self::md5_base64($subkey),$matches['token']);
            }
            return ($matches['CheckSum']==self::makeCheckSum($matches['value'], $matches['token'], $privatekey, $subkey)?$matches['value']:null);
        }

        /**
         * Encripta en valor utilizando una llave y un vector inicial
         * @param string $value Valor original
         * @param string $key Llave de encripcion
         * @param string|null $iv Vector inicial de encripcion. Puede usarse como una segunda llave para agregar seguridad
         * @return string Valor encriptado
         * @see SecureValue::decrypt()
         */
        static function encrypt($value, $key, $iv=null){
            if(!is_string($iv)) $iv='';
            //$iv=str_pad(substr($iv,0,8),8,"\0");
            return self::base64_toUrl(openssl_encrypt($value, 'AES-256-CBC', $key, null,$iv));
            //return self::base64_toUrl(openssl_encrypt($value, 'AES-128-OFB', $key, null,$iv));
        }

        /**
         * Desencripta un valor encriptado en varios niveles, utilizando los valores de la lista de llaves
         * @param string $encryptedValue Valor encriptado
         * @param string $key Llave de encripcion
         * @param string|null $iv Vector inicial de encripcion. Puede usarse como una segunda llave para agregar seguridad
         * @return bool|string Valor original.<br>
         * Se aconseja validar este valor antes de utilizarlo, ya que esta función no verifica que el valor sea el esperado<br>
         * Devuelve FALSE en caso de error
         * @see SecureValue::encrypt()
         */
        static function decrypt($encryptedValue, $key, $iv=null){
            if(!is_string($iv)) $iv='';
            //$iv=str_pad(substr($iv,0,8),8,"\0");
            return openssl_decrypt(self::base64_fromUrl($encryptedValue), 'AES-256-CBC', $key, null,$iv);
            //return openssl_decrypt(self::base64_fromUrl($encryptedValue), 'AES-128-OFB', $key, null,$iv);
        }

        /**
         * Obtiene el token del SecureValue.<br>
         * <b>Importante:</b> No analiza la validez del SecureValue indicado.
         * @param string $secureValue
         * @return string|null Devuelve el token si el parámetro tiene el formato de un SecureValue. De lo contrario devuelve NULL.
         */
        static function getToken($secureValue){
            $matches=array();
            if(!preg_match(self::$regex, $secureValue, $matches)) return null;
            return $matches[2];
        }

        /**
         * Obtiene el checksum del SecureValue.<br>
         * <b>Importante:</b> No analiza la validez del SecureValue indicado.
         * @param string $secureValue
         * @return string|null Devuelve el checksum si el parámetro tiene el formato de un SecureValue. De lo contrario devuelve NULL.
         */
        static function getCheckSum($secureValue){
            $matches=array();
            if(!preg_match(self::$regex, $secureValue, $matches)) return null;
            return $matches[1];
        }

        /**
         * Obtiene el valor original del SecureValue.<br>
         * <b>Importante:</b> No analiza la validez del SecureValue indicado.
         * @param string $secureValue
         * @return string|null Devuelve el valor si el parámetro tiene el formato de un SecureValue. De lo contrario devuelve NULL.
         */
        static function getValue($secureValue){
            $matches=array();
            if(!preg_match(self::$regex, $secureValue, $matches)) return null;
            return $matches[3];
        }

    }

    if(defined('SECUREVALUE_DEFAULT_PRIVATEKEY')) SecureValue::$DEFAULT_PRIVATEKEY=SECUREVALUE_DEFAULT_PRIVATEKEY;
}
if(!function_exists('SecureValue_encode')){
    /**
     * Alias de SecureValue::encode()
     * @see SecureValue::encode()
     */
    function SecureValue_encode($value, $token='', $privatekey=null, $subkey='', $encrypt=false){
        return SecureValue::encode($value, $token, $privatekey, $subkey,$encrypt);
    }
}
if(!function_exists('SecureValue_decode')){
    /**
     * Alias de SecureValue::decode()
     * @see SecureValue::decode()
     */
    function SecureValue_decode($secureValue, $verify_token=null, $privatekey=null, $subkey='', $encrypt=false){
        return SecureValue::decode($secureValue, $verify_token, $privatekey, $subkey,$encrypt);
    }
}
?>
