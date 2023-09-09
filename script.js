$(function() {
    $( ".employee" ).draggable({
        revert: true,
        revertDuration: 0
    });
});

$('.city').droppable({
    drop: function(event, ui) {
        var employee = ui.draggable;           
        $(this).find('#employee-divs').append(employee);
    }
});

$('#save-button').click(function() {
    var employees = [];

    $('.city .employee-div p').each(function() {
        var employee = {
            id: $(this).data('employee-id'),
            city_id: $(this).closest('.city').data('city-id')
        };
        employees.push(employee);
    });

    $.ajax({
        type: 'POST',
        url: 'save-employees.php',
        data: { employees: employees },
        success: function(response) {
            alert('Employees have been saved!');
        },
        error: function(xhr, status, error) {
            alert('Error: ' + error);
        }
    });
});
