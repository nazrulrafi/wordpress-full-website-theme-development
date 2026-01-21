
<!-- Modal -->
<div class="modal fade" id="addListing" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Request for Adding List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body with Form -->
            <div class="modal-body">
                <form id="requestForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="agency" class="form-label">Agency Name</label>
                        <input type="text" class="form-control" id="agency" name="agency">
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</div>
