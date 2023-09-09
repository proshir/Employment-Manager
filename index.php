<!doctype html>
<html lang="en">

    <head>
    
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>City - Employee</title>

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="jquery.js" type="text/javascript"></script>
        <script src="jquery-ui.js" type="text/javascript"></script>
        <link rel="stylesheet" href="styles.css">
        
    </head>

    <body>
        <?php
            require_once('dbconn.php');

            $employee2city_query = "SELECT employee_id, city_id FROM Employee2City";

            $employee2city_result = $conn->query($employee2city_query);

            $employee2city = array();
            while ($row = $employee2city_result->fetch_assoc()) {
                $employee2city[] = array(
                    'employee_id' => $row['employee_id'],
                    'city_id' => $row['city_id']
                );
            }

            $cities_query = "SELECT id, name FROM City";
            $cities_result = $conn->query($cities_query);
            $cities = array();
            while ($row = $cities_result->fetch_assoc()) {
                $cities[$row['id']] = $row['name'];
            }

            $employees_query = "SELECT id, name FROM Employee";
            $employees_result = $conn->query($employees_query);
            $employees = array();
            while ($row = $employees_result->fetch_assoc()) {
                $employees[$row['id']] = array(
                    'name' => $row['name'],
                    'city_id' => null
                );
            }

            foreach ($employee2city as $data) {
                $employee_id = $data['employee_id'];
                $city_id = $data['city_id'];
                $employees[$employee_id]['city_id'] = $city_id;
            }
        ?>
        <button id="save-button">Save</button>
        <div class="container">
            <?php foreach ($cities as $city_id => $city_name): ?>
                <div class="city" data-city-id="<?= $city_id ?>">
                    <h2><?= $city_name ?></h2>
                    <div id="employee-divs" class="employee-div"></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="container_employee_free">
            <h2>Employees</h2>
            <div class="city" data-city-id="<?= null ?>">
                <div id="employee-divs" class="employee-free-div"></div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                var employees = <?= json_encode($employees) ?>;
                var cities = <?= json_encode($cities) ?>;
                for(var employee_id in employees){
                    var employee = employees[employee_id];
                    if(employee.city_id !== null) {
                        var city_name = cities[employee.city_id];
                        var cityElement = $('.city[data-city-id=' + employee.city_id + '] .employee-div');
                        cityElement.append('<p class=employee data-employee-id='+employee_id+'>' + employee.name + '</p>');
                    }
                    else{
                        var empyee_div = $('.employee-free-div');
                        empyee_div.append('<p class=employee data-employee-id='+employee_id+'>' + employee.name + '</p>');
                    }
                }
            });
        </script>
        <script src="script.js" type="text/javascript"></script>
    </body>

</html>