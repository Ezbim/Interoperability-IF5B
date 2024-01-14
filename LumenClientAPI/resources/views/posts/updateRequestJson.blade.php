<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
    <h1>Registration Form</h1>
    <form method="PUT" action="/changeRequestJson">
    <input type="hidden" name="id" value="{{ $result['data']['id'] }}"> <!-- Add a hidden input for ID -->
      <div class="form-group">
        <label for="employeeName">Employee Name</label>
        <input type="text" class="form-control" name="employeeName" value="{{ $result['data']['employee_name'] }} " id="employeeName" placeholder="Enter name">
      </div>
      <div class="form-group">
        <label for="employeeSalary">Employee Salary</label>
        <input type="text" class="form-control" name="employeeSalary" value="{{ $result['data']['employee_salary'] }} " id="employeeSalary" placeholder="Enter salary">
      </div>
      <div class="form-group">
        <label for="employeeAge">Employee Age</label>
        <input type="text" class="form-control" name="employeeAge" value="{{ $result['data']['employee_age'] }} " id="employeeAge" placeholder="Enter age">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>
