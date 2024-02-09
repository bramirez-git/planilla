$(document).ready(function(){

    jQuery(function($) {
        if (!window.Intl) {
            console.log("Calendar can't be displayed because your browser doesn's support `Intl`. You may use a polyfill!");
            return;
        }

        //hide/show relevant alert messages according to device
        if('ontouchstart' in window) {
            $('#alert-1').removeClass('d-none')
            $('#alert-2').addClass('d-none')
        }

        // initialize the external events
        new FullCalendar.Draggable(document.getElementById('external-events'), {
            itemSelector: '.fc-event',
            longPressDelay: 50,
            eventData: function(eventEl) {
                return {
                    title: eventEl.innerText,
                    classNames: eventEl.getAttribute('data-class').split(' ')
                }
            }
        })

        // change styling options and icons
        FullCalendar.BootstrapTheme.prototype.classes = {
            root: 'fc-theme-bootstrap',
            table: 'table-bordered table-bordered brc-default-l2 text-secondary-d1 h-95',
            tableCellShaded: 'bgc-secondary-l3',
            buttonGroup: 'btn-group',
            button: 'btn btn-white btn-h-lighter-blue btn-a-blue',
            buttonActive: 'active',
            popover: 'card card-primary',
            popoverHeader: 'card-header',
            popoverContent: 'card-body',
        };
        FullCalendar.BootstrapTheme.prototype.baseIconClass = 'fa';
        FullCalendar.BootstrapTheme.prototype.iconClasses = {
            close: 'fa-times',
            prev: 'fa-chevron-left',
            next: 'fa-chevron-right',
            prevYear: 'fa-angle-double-left',
            nextYear: 'fa-angle-double-right'
        };
        FullCalendar.BootstrapTheme.prototype.iconOverrideOption = 'FontAwesome';
        FullCalendar.BootstrapTheme.prototype.iconOverrideCustomButtonOption = 'FontAwesome';
        FullCalendar.BootstrapTheme.prototype.iconOverridePrefix = 'fa-';

        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            editable:true,
            themeSystem: 'bootstrap',
            locale:'es',
            headerToolbar: {
                start: 'prev,next today',
                center: 'title',
                end: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            events: function(fetchInfo, successCallback, failureCallback) {
                //alert(fetchInfo.startStr);
                jQuery.ajax({
                    url: "fullCalendar",
                    data: {
                        "inicio": fetchInfo.startStr,
                        "fin": fetchInfo.endStr,
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        var events = [];

                        for (let i in data) {
                            //alert(data[i]['title']);
                            if(data[i]['end']!='')
                            {
                                events.push({
                                    id: data[i]['id'],
                                    title: data[i]['title'],
                                    start: data[i]['start'],
                                    end: data[i]['end'],
                                    allDay: data[i]['allDay'],
                                    className: data[i]['className'],
                                });
                            }
                            else{
                                events.push({
                                    id: data[i]['id'],
                                    title: data[i]['title'],
                                    start: data[i]['start'],
                                    allDay: data[i]['allDay'],
                                    className: data[i]['className'],
                                });
                            }
                        }
                        successCallback(events);
                    }
                });
            },
            selectable: true,
            selectLongPressDelay: 200,

            select: function(date) {
                bootbox.prompt("New Event Title:", function(title) {
                    if (title !== null && title.length > 0) {
                        calendar.addEvent({
                            title: title,
                            start: date.start,
                            end: date.end,
                            allDay: true,
                            classNames: ['text-95', 'bgc-info-d2', 'text-white']
                        });
                    }
                });
            },

            eventClick: function(info) {

                let id = info.event.id.split('-');

                if(id[0]==2)
                {
                    //display a modal
                    var modal =
                        '<div class="modal fade">\
                          <div class="modal-dialog">\
                     <div class="modal-content">\
                      <div class="modal-header">\
                        <h5 class="modal-title">Detalle de evento</h5>\
                        <button type="button" class="close" data-dismiss="modal">&times;</button>\
                      </div>\
                      <div class="modal-body">\
                        <form class="m-0">\
                          <div class="input-group">\
                              <div class="input-groupp-repend align-self-center mr-2">\
                                Nombre:\
                              </div>\
                              <input class="form-control" autocomplete="off" type="text" value="' + info.event.title + '" />\
              </div>\
                              <br>\
                              <a href="{{ url('/colaboradorAccionPersonal/') }}/' + id[1] + '" class="btn px-4 btn-outline-info mb-1">Ver más detalles</a>\
            </form>\
          </div>\
			  </div>\
			 </div>\
			</div>';
                }
                else{
                    //display a modal
                    var modal =
                        '<div class="modal fade">\
                          <div class="modal-dialog">\
                     <div class="modal-content">\
                      <div class="modal-header">\
                        <h5 class="modal-title">Detalle de evento</h5>\
                        <button type="button" class="close" data-dismiss="modal">&times;</button>\
                      </div>\
                      <div class="modal-body">\
                        <form class="m-0">\
                          <div class="input-group">\
                              <div class="input-groupp-repend align-self-center mr-2">\
                                Nombre:\
                              </div>\
                              <input class="form-control" autocomplete="off" type="text" value="' + info.event.title + '" />\
                              </div>\
                            </form>\
                          </div>\
                              </div>\
                             </div>\
                            </div>';
                }

                var modal = $(modal).appendTo('body');
                modal.find('form').on('submit', function(ev){
                    ev.preventDefault();

                    info.event.setProp('title' , $(this).find("input[type=text]").val());

                    modal.modal("hide");
                });
                modal.find('button[data-action=delete]').on('click', function() {
                    info.event.remove();
                    modal.modal("hide");
                });

                modal.modal('show').on('hidden.bs.modal', function(){
                    modal.remove();
                });
            }

        });

        calendar.render();
    });

    $('#tipoActividad').on('change',function()
    {
        let tipoActividad = $('#tipoActividad').val();

        if(tipoActividad==1){
            $('#divAccionPersonal').show();
            $('#divColaboradores').hide();
        }
        else if(tipoActividad==3){
            $('#divAccionPersonal').hide();
            $('#divColaboradores').show();
        }
        else {
            $('#divAccionPersonal').hide();
            $('#divColaboradores').hide();
        }
    });
});
