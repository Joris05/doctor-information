<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-fluid px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="user-plus"></i></div>
                        <?= $title; ?>
                    </h1>
                </div>
                <div class="col-12 col-xl-auto mb-3">
                    <a class="btn btn-sm btn-light text-primary" href="<?= base_url();?>doctor/list">
                        <i class="me-1" data-feather="arrow-left"></i>
                        Back to All Doctors
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-4">
            <form
                id="form-add-doctor"
                onsubmit="event.preventDefault(); return <?= (@$doctor->lastname)?'doUpdateDoctor()':'doAddDoctor()'; ?>">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <img
                        id="doctor-photo"
                        class="img-account-profile rounded-circle mb-2"
                        src="<?= (@$doctor->photo)?base_url().$doctor->photo:base_url().'assets/images/user-placeholder.svg';?>" alt="">
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <button class="btn btn-primary" id="upload-button" type="button">Upload new image</button>
                    <input type="file" name="doctor_photo" id="photo-input" accept="image/*" style="display: none;">
                </div>
            </div>

            <div class="card mt-4 mb-xl-0">
                <div class="card-body">
                    <div class="row gx-3 mb-3">
                        <label class="small mb-1">Specialty</label>
                        <input
                            type="text"
                            class="form-control"
                            name="specialty"
                            value="<?= @$doctor->specialty; ?>"
                            placeholder="Enter Specialty"
                            autocomplete="off"
                            required />
                    </div>
                    <div class="row gx-3 mb-3">
                        <label class="small mb-1">Sub-Specialty</label>
                        <input
                            type="text"
                            class="form-control"
                            name="sub_specialty"
                            value="<?= @$doctor->sub_specialty; ?>"
                            placeholder="Enter Sub-Specialty"
                            autocomplete="off"
                            required />
                    </div>
                    <div class="row gx-3 mb-3">
                        <label class="small mb-1">Category</label>
                        <input
                            type="text"
                            class="form-control"
                            name="category"
                            value="<?= @$doctor->category; ?>"
                            placeholder="Enter Category"
                            autocomplete="off"
                            required />
                    </div>
                    <div class="row gx-3 mb-3">
                        <label class="small mb-1">Join Date</label>
                        <input
                            type="date"
                            class="form-control"
                            name="join_date"
                            value="<?= @$doctor->join_date; ?>"
                            required />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Doctor Details</div>
                <div class="card-body">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Last name</label>
                                <input
                                    value="<?= @$doctor->lastname; ?>"
                                    class="form-control"
                                    id="inputFirstName"
                                    type="text"
                                    name="lastname"
                                    placeholder="Enter Last Name"
                                    autocomplete="off"
                                    required />
                                    <input type="hidden" name="doc_id" value="<?= (@$doctor->doc_id); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">First name</label>
                                <input
                                    value="<?= @$doctor->firstname; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    type="text"
                                    name="firstname"
                                    placeholder="Enter First Name"
                                    autocomplete="off"
                                    required />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Middle name</label>
                                <input
                                    value="<?= @$doctor->middlename; ?>"
                                    class="form-control"
                                    id="inputFirstName"
                                    type="text"
                                    name="middlename"
                                    placeholder="Enter Middle Name"
                                    autocomplete="off"
                                    required />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Birthday</label>
                                <input
                                    value="<?= @$doctor->birthdate; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    name="birthday"
                                    type="date"
                                    required />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Contact No</label>
                                <div class="input-group">
                                    <input
                                        value="<?= @$doctorContact['first_contact']->mobile_no; ?>"
                                        class="form-control additional-contact-no"
                                        id="inputContactNo"
                                        type="number"
                                        name="contactno[]"
                                        placeholder="Enter Contact Number"
                                        autocomplete="off"
                                        required />
                                        <button class="btn btn-outline-secondary" type="button" id="btn-add-contact">+</button>
                                </div>
                            </div>
                        </div>
                        <div id="additional-contact">
                            <?php
                            if (!empty($doctorContact['remaining_contacts'])):
                                $contactIndex = 1;
                                foreach ($doctorContact['remaining_contacts'] as $contact){
                                    $contactIndex++; ?>
                                    <div class="row gx-3 mb-3" id="contact-<?= $contactIndex; ?>">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputFirstName">Another Contact No</label>
                                            <div class="input-group">
                                                <input
                                                    class="form-control additional-contact-no"
                                                    id="inputContactNo-<?= $contactIndex; ?>"
                                                    type="number"
                                                    name="contactno[]"
                                                    placeholder="Enter Contact Number"
                                                    autocomplete="off"
                                                    value="<?= $contact->mobile_no; ?>"
                                                    required />
                                                    <button class="btn btn-outline-danger btn-remove-contact" type="button" data-contact-id="contact-<?= $contactIndex; ?>">-</button>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            endif;
                            ?>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Residential Address</label>
                            <input
                                value="<?= @$doctor->residential_address; ?>"
                                class="form-control"
                                id="inputEmailAddress"
                                type="text"
                                name="address"
                                placeholder="Enter Residential Address"
                                autocomplete="off"
                                required />
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputLastName">PHIC License No</label>
                                <input
                                    value="<?= @$doctor->phic_license_no; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    type="text"
                                    autocomplete="off"
                                    name="phic_license_no"
                                    placeholder="Enter PHIC License No"
                                    required />
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputLastName">Validity Period</label>
                                <input
                                    value="<?= @$doctor->phic_validity_period; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    type="date"
                                    name="phic_validity_period"
                                    required />
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputLastName">Expiry Date</label>
                                <input
                                    value="<?= @$doctor->phic_expiry_date; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    type="date"
                                    name="phic_expiry_date"
                                    required />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputLastName">PRC License No</label>
                                <input
                                    value="<?= @$doctor->prc_license_no; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    type="text"
                                    name="prc_no"
                                    autocomplete="off"
                                    placeholder="Enter PRC License No"
                                    required />
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputLastName">PRC Registration Date</label>
                                <input
                                    value="<?= @$doctor->prc_registration_date; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    type="date"
                                    name="prc_reg_date"
                                    required />
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputLastName">PRC Expiry Date</label>
                                <input
                                    value="<?= @$doctor->prc_expiry_date; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    type="date"
                                    name="prc_expiry_date"
                                    required />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">TIN #</label>
                                <input
                                    value="<?= @$doctor->tin_no; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    type="text"
                                    autocomplete="off"
                                    placeholder="Enter TIN #"
                                    name="tin_no"
                                    required />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Email Address</label>
                                <input
                                    value="<?= @$doctor->email_add ; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    type="email"
                                    placeholder="Enter Email Address"
                                    name="email_add"
                                    autocomplete="off"
                                    required />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputLastName">S2 License No</label>
                                <input
                                    value="<?= @$doctor->s2_license_no; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    type="text"
                                    name="s2_license_no"
                                    autocomplete="off"
                                    placeholder="Enter PHIC License No"
                                    required />
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputLastName">S2 Registration Date</label>
                                <input
                                    value="<?= @$doctor->s2_registration_date; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    type="date"
                                    name="s2_registration_date"
                                    required />
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputLastName">S2 Validity Date</label>
                                <input
                                    value="<?= @$doctor->s2_license_validity; ?>"
                                    class="form-control"
                                    id="inputLastName"
                                    type="date"
                                    name="s2_license_validity"
                                    required />
                            </div>
                        </div>
                        <button
                            class="btn btn-primary"
                            button-message="Saving..."
                            type="submit"
                            id="btn-form-add-doctor">Submit</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>