$(document).ready(function() {
    $(document).on('click','.nav-link', function() {
        var content = $(this).data('content');
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        $('.content_div').hide();
        $('#' + content+'_content').show();
    });


})
 $(document).ready(function() {
        // Initialize TUI Calendar using jQuery wrapper
        var $calEl = $('#calendar').tuiCalendar({
            defaultView: 'month',
            taskView: true,
            scheduleView: true,
            useDetailPopup: true,  // Enables detail popup for schedule creation
            theme: 'default',
            isReadOnly: false,
            template: {
                monthDayname: function(dayname) {
                    return '<span class="calendar-week-dayname-name">' + dayname.label + '</span>';
                }
                // You can customize more templates if needed
            }
        });

        // Get the calendar instance
        var calendarInstance = $calEl.data('tuiCalendar');

        // Add some example schedules
        calendarInstance.createSchedules([
            {
                id: '1',
                calendarId: '1',
                title: 'Meeting with John',
                start: '2024-09-01T10:00:00',
                end: '2024-09-01T11:00:00',
                category: 'time',  // Event category
                dueDateClass: ''
            },
            {
                id: '2',
                calendarId: '2',
                title: 'Conference Call',
                start: '2024-09-02T14:00:00',
                end: '2024-09-02T15:00:00',
                category: 'time',
                dueDateClass: ''
            }
        ]);
    });