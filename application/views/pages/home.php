                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?= $title; ?></h1>
                        <div class="small">
                            <span class="fw-500 text-primary"><?= date('l', strtotime($todaysDate));?></span>
                            · <?= date('F d, Y · h:i A', strtotime($todaysDate));?>
                        </div>
                        
                        <div class="card card-waves mb-4 mt-4">
                            <div class="card-body p-5">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col">
                                        <h2 class="text-primary">Welcome back, your dashboard is ready!</h2>
                                        <p class="text-gray-700">Great job, your affiliate dashboard is ready to go! You can view doctors with expiring or recently expired licenses, generate reports, and take necessary actions using this dashboard.</p>
                                    </div>
                                    <div class="col d-none d-lg-block mt-xxl-n4"><img class="img-fluid px-xl-4 mt-xxl-n5" src="<?= base_url(); ?>assets/images/statistics.svg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-start-lg border-start-primary h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-primary mb-1">Doctors</div>
                                                <div class="h1"><?= $totalDoctors; ?></div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-user fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-start-lg border-start-secondary h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-secondary mb-1">Upcoming Expiry</div>
                                                <div class="h1"><?= $totalExpiringSoon; ?></div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-start-lg border-start-success h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-success mb-1">Recently Expired</div>
                                                <div class="h1"><?= $totalExpiringRecently; ?></div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-mouse-pointer fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-start-lg border-start-info h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="small fw-bold text-info mb-1">Users</div>
                                                <div class="h1"><?= $totalUsers; ?></div>
                                            </div>
                                            <div class="ms-2"><i class="fas fa-users fa-2x text-gray-200"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xxl-4">
                                <div class="row">
                                    <div class="col-xl-6 col-xxl-12">
                                        <div class="card mb-4">
                                            <div class="card-header">Upcoming Expiry</div>
                                            <div class="card-body">
                                                <?php
                                                    foreach($expiringSoon as $soon):
                                                        $photo = ($soon->photo) ? base_url().$soon->photo : base_url().'assets/images/icon/user.png';
                                                ?>
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center flex-shrink-0 me-3">
                                                        <div class="avatar avatar-xl me-3 bg-gray-200">
                                                            <img class="avatar-img img-fluid" src="<?= $photo; ?>" alt="" />
                                                        </div>
                                                        <div class="d-flex flex-column fw-bold">
                                                            <a class="text-dark line-height-normal mb-1" href="#!">
                                                                <?= $soon->lastname .', ' .$soon->firstname . ' ' . $soon->middlename ?>
                                                            </a>
                                                            <div class="small text-muted line-height-normal">
                                                                Expiry Date : <?= $soon->prc_expiry_date; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown no-caret">
                                                        <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownPeople1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="more-vertical"></i></button>
                                                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownPeople1">
                                                            <a class="dropdown-item" href="<?= base_url().'doctor/edit/'.$soon->doc_id; ?>">Update License</a>
                                                            <a class="dropdown-item" href="#!">Send Notification</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-xxl-12">
                                        <div class="card card-header-actions mb-4">
                                            <div class="card-header">
                                                Recently Expired
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                    foreach($expirRecently as $soon):
                                                        $photo = ($soon->photo) ? base_url().$soon->photo : base_url().'assets/images/icon/user.png';
                                                ?>
                                                <div class="d-flex align-items-center justify-content-between mb-4">
                                                    <div class="d-flex align-items-center flex-shrink-0 me-3">
                                                        <div class="avatar avatar-xl me-3 bg-gray-200">
                                                            <img class="avatar-img img-fluid" src="<?= $photo; ?>" alt="" />
                                                        </div>
                                                        <div class="d-flex flex-column fw-bold">
                                                            <a class="text-dark line-height-normal mb-1" href="#!">
                                                                <?= $soon->lastname .', ' .$soon->firstname . ' ' . $soon->middlename ?>
                                                            </a>
                                                            <div class="small text-muted line-height-normal">
                                                                Expiry Date : <?= $soon->prc_expiry_date; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown no-caret">
                                                        <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownPeople1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="more-vertical"></i></button>
                                                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownPeople1">
                                                            <a class="dropdown-item" href="<?= base_url().'doctor/edit/'.$soon->doc_id; ?>">Update License</a>
                                                            <a class="dropdown-item" href="#!">Send Notification</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        