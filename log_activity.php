<?php
function logActivity($conn, $actorRole, $actorId, $action, $targetUserId = null) {

    $actorRole   = mysqli_real_escape_string($conn, $actorRole);
    $action      = mysqli_real_escape_string($conn, $action);
    $actorId     = (int)$actorId;
    $targetUserId = $targetUserId ? (int)$targetUserId : NULL;

    mysqli_query(
        $conn,
        "INSERT INTO activity_logs 
         (actor_role, actor_id, action, target_user_id)
         VALUES ('$actorRole', $actorId, '$action', ".($targetUserId ?? "NULL").")"
    );
}
