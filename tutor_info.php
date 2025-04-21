<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tutor Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      padding: 20px;
    }

    .profile-box {
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 6px;
      padding: 30px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .profile-title {
      color: red;
      font-weight: 700;
      margin-bottom: 25px;
    }

    .profile-label {
      font-weight: 500;
    }

    .form-control[readonly] {
      background-color: #e6e6e6;
      border: none;
      box-shadow: none;
    }

    .change-photo-btn,
    .edit-btn {
      background-color: red;
      color: white;
      font-weight: 500;
      border: none;
      border-radius: 6px;
    }

    .edit-btn {
      float: right;
    }

    .profile-pic {
      width: 250px;
      height: 250px;
      aspect-ratio: 3/4;
      background-color: #ccc;
      border-radius: 6px;
    }

    .btn-spacing {
      margin-top: 10px;
    }
  </style>
</head>
<body>

<div class="container profile-box">
  <div class="d-flex justify-content-between align-items-start mb-4">
    <h2 class="profile-title">My Information</h2>
    <button class="btn edit-btn px-3 py-2" data-bs-toggle="modal" data-bs-target="#editInfoModal">Edit Info</button>
  </div>

  <div class="row">
    <!-- Left Column (Photo) -->
    <div class="col-md-3 d-flex flex-column align-items-center">
      <div class="profile-pic mb-3" id="profilePreview"></div>
      <button class="btn change-photo-btn px-3 py-2" data-bs-toggle="modal" data-bs-target="#changePhotoModal">Change Photo</button>
    </div>

    <!-- Right Column (Details) -->
    <div class="col-md-9">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="profile-label">Name:</label>
          <input type="text" class="form-control" readonly>
        </div>
        <div class="col-md-6">
          <label class="profile-label">Subject:</label>
          <input type="text" class="form-control" readonly>
        </div>

        <div class="col-md-6">
          <label class="profile-label">Years of Experience in Tutoring:</label>
          <input type="text" class="form-control" readonly>
        </div>
        <div class="col-md-6">
          <label class="profile-label">Language:</label>
          <input type="text" class="form-control" readonly>
        </div>

        <div class="col-md-6">
          <label class="profile-label">About Me:</label>
          <textarea class="form-control" rows="3" readonly></textarea>
        </div>
        <div class="col-md-6">
          <label class="profile-label">Credentials:</label>
          <input type="text" class="form-control" readonly>
        </div>

        <div class="col-md-6">
          <label class="profile-label">Gmail Link:</label>
          <input type="text" class="form-control" readonly>
        </div>
        <div class="col-md-6">
          <label class="profile-label">Telegram Link:</label>
          <input type="text" class="form-control" readonly>
        </div>

        <div class="col-md-6">
          <label class="profile-label">Facebook Link:</label>
          <input type="text" class="form-control" readonly>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Change Photo Modal -->
<div class="modal fade" id="changePhotoModal" tabindex="-1" aria-labelledby="changePhotoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePhotoModalLabel">Change Profile Photo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="file" class="form-control" accept="image/*">
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Upload</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Info Modal -->
<div class="modal fade" id="editInfoModal" tabindex="-1" aria-labelledby="editInfoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editInfoModalLabel">Edit Profile Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Name</label>
              <input type="text" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Subject</label>
              <input type="text" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Years of Experience</label>
              <input type="text" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Language</label>
              <input type="text" class="form-control">
            </div>
            <div class="col-md-12">
              <label class="form-label">About Me</label>
              <textarea class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">Credentials</label>
              <input type="text" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Gmail Link</label>
              <input type="text" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Telegram Link</label>
              <input type="text" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Facebook Link</label>
              <input type="text" class="form-control">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Save Changes</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
