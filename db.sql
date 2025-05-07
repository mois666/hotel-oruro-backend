Table users {
  id int
  name char
  last_name varchar
  role bool
  email varchar
  password varchar
}

Table rooms {
  id int
  num_room int
  bed_quantity int
  type varchar
}

Table clients {
  id int
  name char
  last_name varchar
  ci int
}

Table reservation {
  id int
  client_id int
  start_date datetime
  end_date datetime
  simple bool
  double bool
  state  bool
  discount int
  total int
}

Table assignments {
  id int
  room_id int
  reservation_id int
  client_id int
  key_room bool
}
