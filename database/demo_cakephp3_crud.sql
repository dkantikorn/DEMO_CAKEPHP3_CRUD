-- Table: name_prefixes
-- DROP TABLE name_prefixes;
CREATE TABLE name_prefixes
(
  id serial NOT NULL,
  name character varying(100) NOT NULL,
  name_eng character varying(100),
  long_name character varying(512) NOT NULL,
  status character(1) NOT NULL DEFAULT 'A'::bpchar, -- A = Active, N = Inactive , D = Delete
  create_uid integer NOT NULL,
  update_uid integer,
  created timestamp without time zone NOT NULL,
  modified timestamp without time zone,
  order_no integer NOT NULL DEFAULT 0,
  CONSTRAINT name_prefixes_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE name_prefixes
  OWNER TO "demo_cakephp3_crud";
COMMENT ON COLUMN name_prefixes.status IS 'A = Active, N = Inactive , D = Delete';


-- Table: roles
-- DROP TABLE roles;
CREATE TABLE roles
(
  id serial NOT NULL,
  name character varying(256) NOT NULL,
  name_eng character varying(256) NOT NULL,
  description character varying(512),
  status character(1) NOT NULL DEFAULT 'A'::bpchar, -- A = Active,N = Inactive , D = Delete
  create_uid integer NOT NULL,
  update_uid integer,
  created timestamp(6) without time zone NOT NULL,
  modified timestamp(6) without time zone,
  CONSTRAINT roles_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE roles
  OWNER TO "demo_cakephp3_crud";
COMMENT ON COLUMN roles.status IS 'A = Active,N = Inactive , D = Delete';

-- Table: users
-- DROP TABLE users;
CREATE TABLE users
(
  id serial NOT NULL,
  faculty_id integer,
  role_id integer,
  ref_code character varying(32),
  username character varying(64) NOT NULL,
  password character varying(150) NOT NULL,
  name_prefix_id integer NOT NULL,
  first_name character varying(150) NOT NULL,
  last_name character varying(150) NOT NULL,
  email character varying(100) DEFAULT NULL::character varying,
  office_phone character varying(50),
  mobile_phone character varying(20),
  birth_date date,
  address character varying(50),
  moo character varying(50),
  road character varying(50),
  sub_district character varying(50),
  district character varying(50),
  province character varying(50),
  zipcode character varying(50),
  status character(1) DEFAULT NULL::bpchar, -- A = Active, N = Inactive , D = Delete
  picture_path character varying(200) DEFAULT NULL::character varying,
  created timestamp(6) without time zone NOT NULL,
  modified timestamp(6) without time zone,
  CONSTRAINT users_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE users
  OWNER TO "demo_cakephp3_crud";
COMMENT ON COLUMN users.status IS 'A = Active, N = Inactive , D = Delete';

-- Table: courses
-- DROP TABLE courses;
CREATE TABLE courses
(
  id serial NOT NULL,
  faculty_id integer NOT NULL,
  course_code character varying(24) NOT NULL,
  name character varying(1024) NOT NULL,
  credit integer NOT NULL,
  price numeric(16,2),
  detail text,
  status character(1), -- N = New, A = Active, I = Inactive, D = Delete
  created timestamp without time zone NOT NULL,
  modified timestamp without time zone,
  CONSTRAINT courses_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE courses
  OWNER TO "demo_cakephp3_crud";
COMMENT ON COLUMN courses.status IS 'N = New, A = Active, I = Inactive, D = Delete';


-- Table: courses_users
-- DROP TABLE courses_users;
CREATE TABLE courses_users
(
  id bigserial NOT NULL,
  user_id bigint NOT NULL,
  course_id bigint NOT NULL,
  days_attended integer,
  score double precision,
  grade character(1),
  status character(1), -- N = Normal, W = Withdrawal
  created timestamp without time zone NOT NULL,
  modified timestamp without time zone,
  CONSTRAINT courses_users_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE courses_users
  OWNER TO "demo_cakephp3_crud";
COMMENT ON COLUMN courses_users.status IS 'N = Normal, W = Withdrawal';

-- Table: faculties
-- DROP TABLE faculties;
CREATE TABLE faculties
(
  id serial NOT NULL,
  faculty_code character varying(32),
  name character varying(255) NOT NULL,
  detail character varying(512),
  status character(1), -- N = New, A = Active, I = Inactive, D = Delete
  created timestamp without time zone NOT NULL,
  modified timestamp without time zone,
  CONSTRAINT faculties_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE faculties
  OWNER TO "demo_cakephp3_crud";
COMMENT ON COLUMN faculties.status IS 'N = New, A = Active, I = Inactive, D = Delete';
