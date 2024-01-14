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
    <form method="POST" action="/updateRequestJson/{{ $employee->id }}">
      <input type="hidden" name="_method" value="PUT"> <!-- Jika Anda ingin menggunakan metode PUT -->
      <div class="form-group">
        <label for="employeeId">Employee Id</label>
        <input type="text" class="form-control" name="id" id="employeeId" placeholder="Enter Id">
      </div>
      <div class="form-group">
        <label for="employeeName">Employee Name</label>
        <input type="text" class="form-control" name="employeeName" id="employeeName" placeholder="Enter name">
      </div>
      <div class="form-group">
        <label for="employeeSalary">Employee Salary</label>
        <input type="text" class="form-control" name="employeeSalary" id="employeeSalary" placeholder="Enter salary">
      </div>
      <div class="form-group">
        <label for="employeeAge">Employee Age</label>
        <input type="text" class="form-control" name="employeeAge" id="employeeAge" placeholder="Enter age">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>
