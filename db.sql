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
  type varchar
  floor int
  status bool
  price int
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
  simple int
  double int
  state  varchar
  discount double
  total double
}

Table assignments {
  id int
  room_id int
  reservation_id int
  client_id int
  key_room int -- 0 si la llave no esta entredado, 1 si esta entredado, 2 si esta devuelta
}
