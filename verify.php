<?php
$room = \App\Models\Room::create(["name" => "Room A"]);
$group = \App\Models\Group::create(["name" => "Chairs", "room_id" => $room->id]);
$good = \App\Models\Good::create(["id_bmn" => "BMN-001", "group_id" => $group->id, "condition" => "Baik", "date" => "2024-01-01", "acquisition_price" => 500000]);
echo "Created: Room {$room->id}, Group {$group->id}, Good {$good->id}\n";
