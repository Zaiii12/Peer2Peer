<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Sign-Up Request</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    .container-custom {
        max-width: 1350px;
        width: 100%;
      }
      
    .card-custom {
      border-radius: 10px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
      padding: 20px;
      margin-top: 20px;
    }

    .table th,
    .table td {
      vertical-align: middle;
      text-align: center;
    }

    .table th {
      background-color: #f8f9fa;
    }

    .action-icon {
      font-size: 18px;
      padding: 6px 10px;
      border-radius: 10px;
      color: #fff;
      margin: 0 3px;
      cursor: pointer;
    }

    .approve-icon {
      background-color: #2CF200;
    }

    .reject-icon {
      background-color: #FF0000;
    }

    .section-title {
      font-size: 40px;
      font-weight:500;
      color: red;
    }

    .filter-input {
      width: 200px;
    }

    .form-control {
      padding: 3px 8px;
    }
  </style>
</head>
<body>
<?php
    include 'navbar_2.php'; 
?>
<div class="container-custom mx-auto px-3">
  <nav aria-label="breadcrumb" class="mt-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="../frontend/admin_dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page"> Student Sign-up Request</li>
    </ol>
  </nav>

  <div class="card card-custom">
    <div class="mb-3">
      <h3 class="section-title">Student Sign-Up Request</h3>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
      <div>
        Show 
        <input type="number" min="1" class="form-control d-inline-block ms-1 me-1" style="width: 60px;"> 
        entries
      </div>
      <div>
        Filter by: 
        <input type="text" class="form-control d-inline-block ms-1 filter-input">
      </div>
      <div>
        Search: 
        <input type="text" class="form-control d-inline-block ms-1 filter-input">
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Sr–Code</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Email Address</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>04-01-2025</td>
            <td>00-00000</td>
            <td>John Doe</td>
            <td>Male</td>
            <td>doejohn@example.com</td>
            <td>
                <i class="bi bi-hand-thumbs-up-fill action-icon approve-icon"></i>
                <i class="bi bi-hand-thumbs-down-fill action-icon reject-icon"></i>
              </td>
              
          </tr>
          <!-- Empty rows for spacing -->
          <tr><td colspan="7">&nbsp;</td></tr>
          <tr><td colspan="7">&nbsp;</td></tr>
          <tr><td colspan="7">&nbsp;</td></tr>
          <tr><td colspan="7">&nbsp;</td></tr>
          <tr><td colspan="7">&nbsp;</td></tr>
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-2">
      <div>
        Showing 1 - 10 of 25 entries
      </div>
      <nav>
        <ul class="pagination pagination-sm mb-0">
          <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
      </nav>
    </div>

  </div>
</div>

</body>
</html>
