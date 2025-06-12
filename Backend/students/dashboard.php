<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="https://via.placeholder.com/200x200" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">John Doe</h5>
          <h6 class="card-subtitle mb-2 text-muted">Software Engineer</h6>
          <p class="card-text">
            <strong>Email:</strong> john@example.com<br>
            <strong>Phone:</strong> +1 (555) 123-4567<br>
            <strong>Location:</strong> New York, USA
          </p>
          <a href="#" class="btn btn-primary btn-sm">Edit</a>
          <a href="#" class="btn btn-outline-danger btn-sm">Delete</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container mt-5">
  <h3 class="text-center mb-4">Student <strong>Details</strong></h3>
  <table id="studentTable" class="table table-bordered table-striped">
    <thead class="table-primary">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $conn = new mysqli("localhost", "root", "", "itblog_db"); // Replace with your DB
    $result = $conn->query("SELECT * FROM students");
    $i = 1;
    while ($student = $result->fetch_assoc()):
    ?>
      <tr>
        <td><?= $i++ ?></td>
        <td><?= htmlspecialchars($student['name']) ?></td>
        <td><?= htmlspecialchars($student['address']) ?></td>
        <td><?= htmlspecialchars($student['gender']) ?></td>
        <td><?= htmlspecialchars($student['created_at']) ?></td>
        <td>
          <!-- View -->
          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal<?= $student['id'] ?>">
            <i class="fas fa-eye"></i>
          </button>
          <!-- Edit -->
          <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $student['id'] ?>">
            <i class="fas fa-edit"></i>
          </button>
          <!-- Delete -->
          <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $student['id'] ?>">
            <i class="fas fa-trash-alt"></i>
          </button>
        </td>
      </tr>

      <!-- View Modal -->
      <div class="modal fade" id="viewModal<?= $student['id'] ?>" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title">Student Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p><strong>Name:</strong> <?= htmlspecialchars($student['name']) ?></p>
              <p><strong>Gender:</strong> <?= htmlspecialchars($student['gender']) ?></p>
              <p><strong>Address:</strong> <?= htmlspecialchars($student['address']) ?></p>
              <p><strong>Registered At:</strong> <?= htmlspecialchars($student['created_at']) ?></p>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Modal -->
      <div class="modal fade" id="editModal<?= $student['id'] ?>" tabindex="-1">
        <div class="modal-dialog">
          <form method="POST" action="update.php" class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title">Edit Student</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="id" value="<?= $student['id'] ?>">
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($student['name']) ?>" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select">
                  <option <?= $student['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                  <option <?= $student['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" required><?= htmlspecialchars($student['address']) ?></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Save</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Delete Modal -->
      <div class="modal fade" id="deleteModal<?= $student['id'] ?>" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title">Confirm Delete</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete <strong><?= htmlspecialchars($student['name']) ?></strong>?
            </div>
            <div class="modal-footer">
              <a href="delete.php?id=<?= $student['id'] ?>" class="btn btn-danger">Yes, Delete</a>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

    <?php endwhile; ?>
    </tbody>
  </table>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function () {
    $('#studentTable').DataTable();
  });
</script>

</body>
</html>
