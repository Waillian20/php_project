<link href="bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
  <div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">John Doe</h5>
      <span class="badge bg-success">Active</span>
    </div>

    <div class="card-body">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs mb-3" id="detailTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
            Info
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab">
            Activity
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">
            Settings
          </button>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content" id="detailTabContent">
        <!-- Info Tab -->
        <div class="tab-pane fade show active" id="info" role="tabpanel">
          <p><strong>Email:</strong> john@example.com</p>
          <p><strong>Phone:</strong> +1 (555) 123-4567</p>
          <p><strong>Location:</strong> New York, USA</p>
        </div>

        <!-- Activity Tab -->
        <div class="tab-pane fade" id="activity" role="tabpanel">
          <p>Last login: June 10, 2025</p>
          <p>Recent actions: Updated profile, Changed password</p>
        </div>

        <!-- Settings Tab with Accordion -->
        <div class="tab-pane fade" id="settings" role="tabpanel">
          <div class="accordion" id="settingsAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                  Privacy Settings
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#settingsAccordion">
                <div class="accordion-body">
                  <p>Email visibility: <strong>Private</strong></p>
                  <p>Profile visibility: <strong>Public</strong></p>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                  Notification Settings
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#settingsAccordion">
                <div class="accordion-body">
                  <p>Email alerts: <strong>Enabled</strong></p>
                  <p>SMS alerts: <strong>Disabled</strong></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    
    <div class="card-footer text-end">
      <button class="btn btn-primary btn-sm">Edit</button>
      <button class="btn btn-outline-danger btn-sm">Delete</button>
    </div>
  </div>
</div>

<script src="bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
