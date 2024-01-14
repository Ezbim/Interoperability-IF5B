<html>
<head>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
</head>
<body>
  <div class="container">
  <?php if (isset($result['message'])): ?>
                <div class="alert alert-success">
                    <?php echo $result['message']; ?>
                </div>
            <?php endif; ?>
    <h1>List Post</h1>
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Employee Name</th>
          <th>Employee Salary</th>
          <th>Employee Age</th>
          <th>Profile Image</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody> <!-- Add this opening <tbody> tag -->
        <?php
          foreach ($results['data'] as $result) {
            echo "<tr>";
            echo "<td>" . $result['id'] . "</td>";
            echo "<td>" . $result['employee_name'] . "</td>";
            echo "<td>" . $result['employee_salary'] . "</td>";
            echo "<td>" . $result['employee_age'] . "</td>";
            echo "<td>" . $result['profile_image'] . "</td>";
            echo "<td>" . "<a href='/getRequestJson/" . $result['id'] . "'>Show</a> | <a href='/updateRequestJson/" . $result['id'] . "'>Update</a> | <a href='/deleteRequestJson/" . $result['id'] . "'>Delete</a>"  . "</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
