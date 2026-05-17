<?php 
require_once __DIR__ . '/../includes/bootstrap.php';
require_admin();

require_once __DIR__ . '/../includes/admin_header.php';
?>      

<section class="container-fluid p-4">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
              <!-- Page header -->
              <div class="border-bottom pb-3 mb-3 d-flex flex-column flex-lg-row gap-3 align-items-lg-center justify-content-between">
                <div class="d-flex flex-column gap-1">
                  <h1 class="mb-0 h2 fw-bold">Create New Project</h1>
                  <!-- Breadcrumb -->
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="admin-dashboard.html">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item">
                        <a href="#">Project</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Create Project</li>
                    </ol>
                  </nav>
                </div>
                <!-- button -->
                <div>
                  <a href="project-grid.html" class="btn btn-primary me-2">Back to Project</a>
                </div>
              </div>
            </div>
          </div>
          <div class="py-6">
            <!-- row -->
            <div class="row">
              <div class="offset-xl-3 col-xl-6 col-md-12 col-12">
                <!-- card -->
                <div class="card">
                  <!-- card body -->
                  <div class="card-body p-lg-6">
                    <!-- form -->
                    <form class="row gx-3 needs-validation" novalidate="">
                      <!-- form group -->
                      <div class="mb-3 col-12">
                        <label class="form-label">
                          Name
                          <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" placeholder="Enter project title" required="">
                        <div class="invalid-feedback">Please enter first title.</div>
                      </div>
                      <!-- form group -->
                      <div class="mb-3 col-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" placeholder="Enter brief about project..." rows="3" required=""></textarea>
                        <div class="invalid-feedback">Please enter messages.</div>
                      </div>
                      <!-- form group -->
                      <div class="mb-3 col-md-6 col-12">
                        <label class="form-label">
                          Start Date
                          <span class="text-danger">*</span>
                        </label>
                        <div class="input-group me-3">
                          <input class="form-control flatpickr flatpickr-input" type="text" placeholder="Select Date" aria-describedby="basic-addon2" readonly="readonly">

                          <span class="input-group-text" id="basic-addon2"><i class="fe fe-calendar"></i></span>
                        </div>
                      </div>
                      <!-- form group -->
                      <div class="mb-3 col-md-6 col-12">
                        <label class="form-label">
                          End Date
                          <span class="text-danger">*</span>
                        </label>
                        <div class="input-group me-3">
                          <input class="form-control flatpickr flatpickr-input" type="text" placeholder="Select Date" aria-describedby="basic-addon3" readonly="readonly">

                          <span class="input-group-text" id="basic-addon3"><i class="fe fe-calendar"></i></span>
                        </div>
                      </div>
                      <!-- form group -->
                      <div class="mb-3 col-md-6 col-12">
                        <label class="form-label" for="privacy">Privacy</label>
                        <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-select choices__input" data-choices="" id="privacy" required="" hidden="" tabindex="-1" data-choice="active"><option value="" data-custom-properties="[object Object]">Select Privacy</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">Select Privacy</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--privacy-item-choice-4" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="4" data-value="" data-select-text="" data-choice-selectable="" aria-selected="true">Select Privacy</div><div id="choices--privacy-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Private to project members" data-select-text="" data-choice-selectable="">Private to project members</div><div id="choices--privacy-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Private to you" data-select-text="" data-choice-selectable="">Private to you</div><div id="choices--privacy-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Public to you team" data-select-text="" data-choice-selectable="">Public to you team</div></div></div></div>
                        <div class="invalid-feedback">Please choose option.</div>
                      </div>
                      <!-- form group -->
                      <div class="mb-3 col-md-6 col-12">
                        <label class="form-label" for="teamMembers">Team Members</label>
                        <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-select choices__input" data-choices="" id="teamMembers" required="" hidden="" tabindex="-1" data-choice="active"><option value="" data-custom-properties="[object Object]">Assign to owner</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">Assign to owner</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--teamMembers-item-choice-1" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="1" data-value="" data-select-text="" data-choice-selectable="" aria-selected="true">Assign to owner</div><div id="choices--teamMembers-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Assign to Owner" data-select-text="" data-choice-selectable="">Assign to Owner</div><div id="choices--teamMembers-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Courtney Henry" data-select-text="" data-choice-selectable="">Courtney Henry</div><div id="choices--teamMembers-item-choice-4" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="4" data-value="Eleanor Pena" data-select-text="" data-choice-selectable="">Eleanor Pena</div></div></div></div>
                        <div class="invalid-feedback">Please choose option.</div>
                      </div>
                      <!-- form group -->
                      <div class="mb-3 col-md-6 col-12">
                        <label class="form-label" for="budget">Budget</label>
                        <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-select choices__input" data-choices="" id="budget" required="" hidden="" tabindex="-1" data-choice="active"><option value="" data-custom-properties="[object Object]">Project Budget</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">Project Budget</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--budget-item-choice-3" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="3" data-value="" data-select-text="" data-choice-selectable="" aria-selected="true">Project Budget</div><div id="choices--budget-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="Based on Project Amount" data-select-text="" data-choice-selectable="">Based on Project Amount</div><div id="choices--budget-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Based on Project Hours" data-select-text="" data-choice-selectable="">Based on Project Hours</div></div></div></div>
                        <div class="invalid-feedback">Please choose option.</div>
                      </div>
                      <!-- form group -->
                      <div class="mb-3 col-md-6 col-12">
                        <label class="form-label" for="priority">Priority</label>
                        <div class="choices" data-type="select-one" tabindex="0" role="listbox" aria-haspopup="true" aria-expanded="false"><div class="choices__inner"><select class="form-select choices__input" data-choices="" id="priority" required="" hidden="" tabindex="-1" data-choice="active"><option value="" data-custom-properties="[object Object]">Set Priority</option></select><div class="choices__list choices__list--single"><div class="choices__item choices__placeholder choices__item--selectable" data-item="" data-id="1" data-value="" data-custom-properties="[object Object]" aria-selected="true">Set Priority</div></div></div><div class="choices__list choices__list--dropdown" aria-expanded="false"><div class="choices__list" role="listbox"><div id="choices--priority-item-choice-4" class="choices__item choices__item--choice is-selected choices__placeholder choices__item--selectable is-highlighted" role="option" data-choice="" data-id="4" data-value="" data-select-text="" data-choice-selectable="" aria-selected="true">Set Priority</div><div id="choices--priority-item-choice-1" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="1" data-value="High" data-select-text="" data-choice-selectable="">High</div><div id="choices--priority-item-choice-2" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="2" data-value="Low" data-select-text="" data-choice-selectable="">Low</div><div id="choices--priority-item-choice-3" class="choices__item choices__item--choice choices__item--selectable" role="option" data-choice="" data-id="3" data-value="Medium" data-select-text="" data-choice-selectable="">Medium</div></div></div></div>
                        <div class="invalid-feedback">Please choose option.</div>
                      </div>

                      <div class="col-md-3 col-12 mb-4">
                        <div>
                          <!-- logo -->
                          <h5 class="mb-3">Project Logo</h5>
                          <div class="icon-shape icon-xxl border rounded position-relative">
                            <span class="position-absolute"><i class="bi bi-image fs-3"></i></span>
                            <input class="form-control border-0 opacity-0" type="file">
                          </div>
                        </div>
                      </div>
                      <div class="col-12 mb-4">
                        <h5 class="mb-3">Cover Image</h5>

                        <div id="my-dropzone" class="dropzone mt-4 border-dashed rounded-2 min-h-0"></div>
                      </div>
                      <div class="col-md-8"></div>
                      <!-- button -->
                      <div class="col-12">
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <button type="button" class="btn btn-outline-primary ms-2" data-bs-dismiss="offcanvas" aria-label="Close">Close</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
<?php require_once __DIR__ . '/../includes/admin_footer.php'; ?>