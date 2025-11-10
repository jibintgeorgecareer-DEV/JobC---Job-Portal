<?php
// get_skills.php
include("../Assets/Connection/connection.php");

if(isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
    
    // Fetch technical skills related to the selected job category
    $skills_qry = "SELECT DISTINCT ts.technical_skill_id, ts.technical_skill_name 
                   FROM tbl_technical_skills ts
                   INNER JOIN job_technical_skills jts ON ts.technical_skill_id = jts.technical_skill_id
                   WHERE jts.job_category_id = '".$category_id."'
                   ORDER BY ts.technical_skill_name";
    
    $skills_result = $con->query($skills_qry);
    
    if($skills_result->num_rows > 0) {
        while($skill = $skills_result->fetch_assoc()) {
            ?>
            <div class="skill-item">
                <input type="checkbox" 
                       name="technical_skills[]" 
                       id="skill_<?php echo $skill['technical_skill_id']; ?>" 
                       value="<?php echo $skill['technical_skill_id']; ?>">
                <label for="skill_<?php echo $skill['technical_skill_id']; ?>">
                    <?php echo $skill['technical_skill_name']; ?>
                </label>
            </div>
            <?php
        }
    } else {
        echo '<div class="loading">No technical skills found for this category</div>';
    }
}
?>