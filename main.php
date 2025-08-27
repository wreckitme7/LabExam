<!DOCTYPE html>
<html>
<head>
    <title>Grade Calculator</title>
    <style>
        body {
            font-family: Arial;
            margin: 20px;
        }
        .container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
        }
        h1 {
            text-align: center;
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="number"] {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 8px;
            background: #ddd;
            border: 1px solid #000;
            cursor: pointer;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #000;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Grade Calculator</h1>
        <p>Weights: Quiz (30%), Assignment (30%), Exam (40%)</p>
        
        <form method="POST">
            <div class="form-group">
                <label for="quiz">Quiz Score (0-100):</label>
                <input type="number" id="quiz" name="quiz" min="0" max="100" step="0.01" required 
                       value="<?php echo isset($_POST['quiz']) ? $_POST['quiz'] : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="assignment">Assignment Score (0-100):</label>
                <input type="number" id="assignment" name="assignment" min="0" max="100" step="0.01" required 
                       value="<?php echo isset($_POST['assignment']) ? $_POST['assignment'] : ''; ?>">
            </div>
            
            <div class="form-group">
                <label for="exam">Exam Score (0-100):</label>
                <input type="number" id="exam" name="exam" min="0" max="100" step="0.01" required 
                       value="<?php echo isset($_POST['exam']) ? $_POST['exam'] : ''; ?>">
            </div>
            
            <button type="submit" name="calculate">Calculate Grade</button>
        </form>
        
        <?php
        if (isset($_POST['calculate'])) {
            $quiz = $_POST['quiz'];
            $assignment = $_POST['assignment'];
            $exam = $_POST['exam'];
            
            $error = "";
            
            if (!is_numeric($quiz) || $quiz < 0 || $quiz > 100) {
                $error = "Quiz score must be a number between 0 and 100.";
            }
            elseif (!is_numeric($assignment) || $assignment < 0 || $assignment > 100) {
                $error = "Assignment score must be a number between 0 and 100.";
            }
            elseif (!is_numeric($exam) || $exam < 0 || $exam > 100) {
                $error = "Exam score must be a number between 0 and 100.";
            }
            
            if (empty($error)) {
                $quiz_weight = 0.30;
                $assignment_weight = 0.30;
                $exam_weight = 0.40;
                
                $weighted_average = ($quiz * $quiz_weight) + ($assignment * $assignment_weight) + ($exam * $exam_weight);
                
                if ($weighted_average >= 90) {
                    $letter_grade = "A";
                } elseif ($weighted_average >= 80) {
                    $letter_grade = "B";
                } elseif ($weighted_average >= 70) {
                    $letter_grade = "C";
                } elseif ($weighted_average >= 60) {
                    $letter_grade = "D";
                } else {
                    $letter_grade = "F";
                }
                
                echo "<div class='result'>";
                echo "<h2>Result</h2>";
                echo "<p>Weighted Average: " . number_format($weighted_average, 2) . "</p>";
                echo "<p>Letter Grade: $letter_grade</p>";
                echo "</div>";
            } else {
                echo "<p class='error'>$error</p>";
            }
        }
        ?>
    </div>
</body>
</html>