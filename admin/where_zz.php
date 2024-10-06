if(($s->key) != NULL){
    $w1 = "(patient.HN LIKE '{$s->key}%' OR `patient_name` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%' )";
}
if(($s->date) != NULL){
    $w2 = "(appointment_date = '{$s->date}')";
}
if(($s->status) != NULL){
    $w3 = "(appointment_status = '{$s->status}')";
}
if(($s->time) != NULL){
    $w4 = "(appointment_time = '{$s->time}')";
}
$where = $w1 . "and" . $w2 . "and" . $w3 . "and" . $w4 ;
$sql .= $where;

if(($s->key)!= NULL & ($s->date) != NULl & ($s->status) != NULl & ($s->time) != NULL){ // เลือก ทุกอย่าง ค่าไม่ว่าง ให้แสดง 
                    $sql .= " WHERE (patient.HN LIKE '{$s->key}%' OR `patient_name` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%' ) AND `appointment_date` = '{$s->date}' AND `status` = '{$s->status}';"; 
                }
                else if(($s->key) != NULL & ($s->date) != NULl ){ //เลือกแค่ key + date เหมือนแสดง 
                    $sql .= " WHERE (patient.HN LIKE '{$s->key}%' OR `patient_name` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%') AND `appointment_date` = '{$s->date}';"; 
                }
                else if(($s->key) != NULL & ($s->status) != NULl ){ //เลือกแค่ key + status เหมือนแสดง 
                    $sql .= " WHERE (patient.HN LIKE '{$s->key}%' OR `patient_name` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%') AND `status` = '{$s->status}';"; 
                }
                else if(($s->date) != NULL & ($s->status) != NULl ){ //เลือกแค่ date + status เหมือนแสดง 
                    $sql .= " WHERE `appointment_date` = '{$s->date}' AND `status` = '{$s->status}';"; 
                }
                else if(($s->key)== NULL & ($s->date) == NULl & ($s->status) == NULl ){ // ไม่เลือกอะไรเลย แสดงหมด
                    $sql .= " WHERE 1"; 
                }
                else if(($s->key) != NULL ){ //เลือกแค่ key แสดงแค่เหมือน key  
                    $sql .= " WHERE (patient.HN LIKE '{$s->key}%' OR `patient_name` LIKE '{$s->key}%' OR `patient_idcard` LIKE '{$s->key}%' );"; 
                }
                else if(($s->date) != NULL) // เลือกแค่ date แสดงแค่เหมือน date 
                { 
                    $sql .= " WHERE (`appointment_date` = '{$s->date}' );"; 
                }
                else if(($s->status) != NULL) // เลือกแค่ status แสดงแค่เหมือน status
                { 
                    $sql .= " WHERE (`status` = '{$s->status}' );"; 
                }     
