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
                    <a class="btn btn-sm btn-light text-primary" href="<?= base_url();?>user/list">
                        <i class="me-1" data-feather="arrow-left"></i>
                        Back to All Users
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-6">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">User Details</div>
                <div class="card-body">
                    <form
                        id="form-add-user"
                        onsubmit="event.preventDefault(); return <?= (@$user->complete_name)?'doUpdateUser()':'doAddUser()'; ?>">
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Complete Name</label>
                            <input
                                class="form-control"
                                id="inputEmailAddress"
                                type="text"
                                placeholder="Enter your complete name"
                                autocomplete="off"
                                name="complete_name"
                                value="<?= @$user->complete_name; ?>"
                                required />
                                <input type="hidden" name="user_id" value="<?= @$user->user_id; ?>">
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Username</label>
                                <input
                                    class="form-control"
                                    id="inputFirstName"
                                    type="text"
                                    placeholder="Enter your username"
                                    autocomplete="off"
                                    name="username"
                                    value="<?= @$user->username; ?>"
                                    required />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Default Password</label>
                                <input
                                    class="form-control"
                                    id="inputLastName"
                                    type="text"
                                    readonly
                                    name="password"
                                    autocomplete="off"
                                    value="<?= (@$user->user_id)?'':'dis-2024'; ?>" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1">Role</label>
                            <select name="user_type" required class="form-select" aria-label="Default select example">
                                <option
                                    <?= (@$user->complete_name) ? '' : "selected"; ?>
                                    disabled="">Select a role:</option>
                                <option
                                    <?= (@$user->user_type === 'administrator') ? 'selected' : ''; ?>
                                    value="administrator">Administrator</option>
                                <option
                                    <?= (@$user->user_type === 'secretary') ? 'selected' : ''; ?>
                                    value="secretary">Secretary</option>
                            </select>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-primary"
                            button-message="Saving..."
                            id="btn-form-add-user">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>