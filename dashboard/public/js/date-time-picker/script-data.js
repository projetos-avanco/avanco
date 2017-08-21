jQuery(function(){

  $.datetimepicker.setLocale('pt-BR');
 jQuery('#date_timepicker_start').datetimepicker({
  format:'d-m-Y',
  onShow:function( ct ){
   this.setOptions({
    maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false

  });
  },
  timepicker:false
 });


 jQuery('#date_timepicker_end').datetimepicker({
  format:'d-m-Y',
  onShow:function( ct ){
   this.setOptions({
    minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
   })

  },
  timepicker:false
 });
});
