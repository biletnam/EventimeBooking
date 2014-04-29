<?php
function get_reservations() {
    global $db;
    $query = 'SELECT * FROM reservations
              ORDER BY reservation_id';
    $result = $db->query($query);
    return $result;
}

function get_reservation_name($user_name) {
    global $db;
    $query ="SELECT m.member_name, m.member_email, m.member_password, m.member_first_name, m.member_last_name, m.member_home_address, m.member_mobile_telephone, m.member_telephone, m.member_birth, r.reservation_id, r.reservation_event_id,r.reservation_reserved_seats, e.event_title, s.event_show_date, e.event_price, s.event_show_seats
                FROM members AS m
                     LEFT JOIN reservations AS r ON r.reservation_member_name = m.member_name
                     LEFT JOIN events AS e ON e.event_id = r.reservation_event_id
                     LEFT JOIN event_show AS s ON s.event_show_id = r.reservation_event_show_id
                WHERE member_name =  '$user_name'";
    $reservations = $db->query($query);
    return $reservations;

    // function get_reservation_event($reservation_id) {
    // global $db;
    // $query ="SELECT m.member_name, m.member_email, m.member_password, m.member_first_name, m.member_last_name, m.member_home_address, m.member_mobile_telephone, m.member_telephone, m.member_birth, r.reservation_event_id
    //             FROM members AS m
    //                  LEFT JOIN reservations AS r ON r.reservation_member_name = m.member_name
    //             WHERE member_name =  '$user_name'";
    // $reservation_events = $db->query($query);
    // return $reservation_events;
}
?>