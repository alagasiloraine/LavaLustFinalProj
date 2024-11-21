<!-- Job Post Modal -->
    <div class="modal fade" id="jobPostModal" tabindex="-1" aria-labelledby="jobPostModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="jobPostModalLabel">Post a Job</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="jobPostForm" method="POST" action="<?=site_url('user/employer/job-post');?>">
              <!-- Job Title -->
              <div class="mb-3">
                <label for="jobTitle" class="form-label">Job Title</label>
                <input type="text" class="form-control" id="jobTitle" name="title" required>
              </div>

              <!-- Job Description -->
              <div class="mb-3">
                <label for="jobDescription" class="form-label">Job Description</label>
                <textarea class="form-control" id="jobDescription" name="description" rows="3" required></textarea>
              </div>

              <!-- Job Requirements -->
              <div class="mb-3">
                <label for="jobRequirements" class="form-label">Requirements</label>
                <textarea class="form-control" id="jobRequirements" name="requirements" rows="3" required></textarea>
              </div>

              <!-- Job Location -->
              <div class="mb-3">
                <label for="jobLocation" class="form-label">Location</label>
                <input type="text" class="form-control" id="jobLocation" name="location" required>
              </div>

              <div class="mb-3">
                <label for="jobSalary" class="form-label">Salary</label>
                <input type="text" class="form-control" id="salary" name="salary" required>
              </div>

              <!-- Job Type -->
              <div class="mb-3">
                <label for="jobType" class="form-label">Job Type</label>
                <select class="form-select" id="jobType" name="job_type" required>
                  <option value="full-time">Full-time</option>
                  <option value="part-time">Part-time</option>
                  <option value="remote">Remote</option>
                </select>
              </div>

              <!-- Job Status -->
              <div class="mb-3">
                <label for="jobStatus" class="form-label">Status</label>
                <select class="form-select" id="jobStatus" name="status" required>
                  <option value="active">Active</option>
                  <option value="inactive">Inactive</option>
                </select>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>