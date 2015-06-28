$(function() {
$( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd 00:00:00"});
});
$(function() {
$( "#start_date" ).datepicker({
defaultDate: "today",
dateFormat: "yy-mm-dd",
onClose: function( selectedDate ) {
$( "#end_date" ).datepicker( "option", "minDate", selectedDate );
}
});
$( "#end_date" ).datepicker({
defaultDate: "+1w",
dateFormat: "yy-mm-dd",
onClose: function( selectedDate ) {
$( "#start_date" ).datepicker( "option", "maxDate", selectedDate );
}
});
});
$(function() {
$( "#voting_start_date" ).datepicker({
defaultDate: "+8d",
dateFormat: "yy-mm-dd",
onClose: function( selectedDate ) {
$( "#voting_end_date" ).datepicker( "option", "minDate", selectedDate );
}
});
$( "#voting_end_date" ).datepicker({
defaultDate: "+15d",
dateFormat: "yy-mm-dd",
onClose: function( selectedDate ) {
$( "#voting_start_date" ).datepicker( "option", "maxDate", selectedDate );
}
});
});