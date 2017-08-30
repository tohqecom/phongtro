$(document).ready(function(){
        var min = returnAsMin(new Date());

        $("#date-start").attr({
        'min': min,
        });

        $("#date-end").attr({
        'min': min,
        });

        $("#date-start").change(function(e){
            var startDate = new Date($('#date-start').val());

            var min = returnAsMin(startDate);

            $("#date-end").attr({
                'min': min,
            });
            var endDate = new Date($('#date-end').val());
            var cost = $('#cost').html();

            if(checkDates(startDate, endDate)){
                var diff = Math.abs(endDate - startDate);
                var totalDays = calculateDays(diff)
                $("#total-days").html("Total days: " + totalDays + ' at ' + cost +'$ per day');
                $("#total-cost").html('Total cost: ' + totalDays*cost+"$");
            }

        });
        $("#date-end").change(function(){
            var startDate = new Date($('#date-start').val());
            var endDate = new Date($('#date-end').val());
            var cost = $('#cost').html();

            if(checkDates(startDate, endDate)){
                var diff = Math.abs(endDate - startDate);
                var totalDays = calculateDays(diff)
                $("#total-days").html("Total days: " + totalDays + ' at ' + cost +'$ per day');
                $("#total-cost").html('Total cost: ' + totalDays*cost+"$");
            }

        });
});

function checkDates(startDate,endDate){
    if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime()))
        return true;
    return false;
}

function calculateDays(milis){
    var s = milis/1000;
    var m = s/60;
    var h = m/60;
    var d = Math.ceil(h/24);

    return d;
}

function returnAsMin(date){
    var d= date;
    var y = d.getFullYear().toString();
    var m = (d.getMonth()+1).toString();
    var d  = d.getDate().toString();
    var min = y +'-'+ (m[1]?m:"0"+m[0]) +'-'+ (d[1]?d:"0"+d[0]);

    return min;
}