<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background: url('/images/login-background.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .logo {
            position: absolute;
            top: 20%;
            left: 2%;
            z-index: 10;
        }

        .form-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            height: 100vh;
            padding-right: 45px; 
        }

        .form-card {
            border: 1px solid rgb(141, 217, 242);
            padding: 30px;
            width: 550px;
            height: 600px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-right: 45px; 
            border-radius: 15px;
        }
    </style>
</head>
<body>
    <!-- Logo -->
    <div class="logo">
        <img src="/images/logo.png" alt="Go Pedal PH Logo" class="w-[200px]">
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <div class="form-card">
            <h3 class="mb-2 fw-bold">User Profiling</h3>
            <form action="{{ route('storeFormRegistration.index') }}" method="POST" id="profiling_form">
                @csrf
                <input type="hidden" name="account_id" value="{{ $account_id }}">

                <div class="row mb-0">
                    <div class="col-md-6">
                        <label for="birthdate" class="form-label" style="margin-bottom: -5px">Birthday</label>
                        <input type="date" class="form-control" name="birthdate" id="birthdate" required max="{{ now()->toDateString() }}">
                        <label class="form-label d-block">Gender</label>
                        <div class="form-check form-check-inline ps-5">
                            <input class="form-check-input" type="radio" name="sex" id="female" value="female" required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sex" id="male" value="male">
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="height" class="form-label" style="margin-bottom: -5px">Height (cm)</label>
                        <input type="number" class="form-control" name="height" id="height" min="0" required>
                        <label for="weight" class="form-label" style="margin-bottom: -5px">Weight (kg)</label>
                        <input type="number" class="form-control" name="weight" id="weight" min="0" required>
                    </div>
                </div>

                <hr class="my-2">
        
                <h3 class="fw-bold mb-2 mt-0">Ride Preference</h3>
        
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Activity Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activity_type[]" value="Commuting" id="commuting">
                            <label class="form-check-label" for="commuting">Commuting</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activity_type[]" value="Leisure" id="leisure">
                            <label class="form-check-label" for="leisure">Leisure</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activity_type[]" value="Racing" id="racing">
                            <label class="form-check-label" for="racing">Racing</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="activity_type[]" value="Off-roading" id="offroading">
                            <label class="form-check-label" for="offroading">Off-roading</label>
                        </div>
                    </div>
        
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Primary Riding Terrain</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terrain[]" value="Off-road trails" id="trails">
                            <label class="form-check-label" for="trails">Off-road trails</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terrain[]" value="Mountains" id="mountains">
                            <label class="form-check-label" for="mountains">Mountains</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terrain[]" value="Coastal Roads" id="coastal">
                            <label class="form-check-label" for="coastal">Coastal Roads</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terrain[]" value="Mixed" id="mixed">
                            <label class="form-check-label" for="mixed">Mixed</label>
                        </div>
                    </div>
                </div>
        
                <div class="mb-2">
                    <label class="form-label d-block fw-bold">Experience Level</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="experience_level" id="beginner" value="Beginner" required>
                        <label class="form-check-label" for="beginner">Beginner</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="experience_level" id="intermediate" value="Intermediate">
                        <label class="form-check-label" for="intermediate">Intermediate</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="experience_level" id="skilled" value="Skilled">
                        <label class="form-check-label" for="skilled">Skilled</label>
                    </div>
                </div>
                
                <hr class="my-1">
        
                <div class="row mb-2">
                    <label class="col-8 form-label d-block">Performs Own Maintenance?</label>
                    <div class="col-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="maintenance" id="maintenance_yes" value="yes" required>
                            <label class="form-check-label" for="maintenance_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="maintenance" id="maintenance_no" value="no">
                            <label class="form-check-label" for="maintenance_no">No</label>
                        </div>
                    </div>
                </div>
        
                <div class="row mb-0">
                    <label class="col-8 form-label d-block">Interested in Upgrades/Custom Parts?</label>
                    <div class="col-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="custom_parts" id="custom_yes" value="yes" required>
                            <label class="form-check-label" for="custom_yes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="custom_parts" id="custom_no" value="no">
                            <label class="form-check-label" for="custom_no">No</label>
                        </div>
                    </div>
                </div>

                <hr class="my-1">
        
                <div class="text-end">
                    <button type="submit" class="btn py-2 px-0">
                        <h5 class="text-primary">
                            Continue <i class="bi bi-arrow-right ms-2"></i>
                        </h5>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("profiling_form").addEventListener("submit", function (e) {
            const activityChecked = document.querySelectorAll("input[name='activity_type[]']:checked").length > 0;
            const terrainChecked = document.querySelectorAll("input[name='terrain[]']:checked").length > 0;

            if (!activityChecked || !terrainChecked) {
                e.preventDefault();
                alert("Please select at least one option for Activity Type and Primary Riding Terrain.");
            }
        });
    </script>
</body>
</html>
