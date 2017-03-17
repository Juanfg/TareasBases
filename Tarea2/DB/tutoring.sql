--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.2
-- Dumped by pg_dump version 9.6.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: appointment_insert(); Type: FUNCTION; Schema: public; Owner: Lalo
--

CREATE FUNCTION appointment_insert() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    INSERT INTO appointment_register(appointment, date) 
    VALUES(NEW.id, NOW());

    RETURN NEW;
END;
$$;


ALTER FUNCTION public.appointment_insert() OWNER TO "Lalo";

--
-- Name: how_many_appointments(character varying, character varying); Type: FUNCTION; Schema: public; Owner: Lalo
--

CREATE FUNCTION how_many_appointments(teacher_name character varying, teacher_last_name character varying) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare
total_appointments integer;
BEGIN
    SELECT count(*) into total_appointments FROM appointment, teacher WHERE teacher.id = appointment.teacher AND teacher.name = teacher_name AND teacher.last_name = teacher_last_name;
    RETURN total_appointments;
END;
$$;


ALTER FUNCTION public.how_many_appointments(teacher_name character varying, teacher_last_name character varying) OWNER TO "Lalo";

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: appointment; Type: TABLE; Schema: public; Owner: Lalo
--

CREATE TABLE appointment (
    id integer NOT NULL,
    student integer,
    schedule integer,
    teacher integer,
    subject integer,
    topic character varying(60),
    day date
);


ALTER TABLE appointment OWNER TO "Lalo";

--
-- Name: appointment_id_seq; Type: SEQUENCE; Schema: public; Owner: Lalo
--

CREATE SEQUENCE appointment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE appointment_id_seq OWNER TO "Lalo";

--
-- Name: appointment_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Lalo
--

ALTER SEQUENCE appointment_id_seq OWNED BY appointment.id;


--
-- Name: appointment_register; Type: TABLE; Schema: public; Owner: Lalo
--

CREATE TABLE appointment_register (
    id integer NOT NULL,
    appointment integer,
    date timestamp without time zone
);


ALTER TABLE appointment_register OWNER TO "Lalo";

--
-- Name: appointment_register_id_seq; Type: SEQUENCE; Schema: public; Owner: Lalo
--

CREATE SEQUENCE appointment_register_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE appointment_register_id_seq OWNER TO "Lalo";

--
-- Name: appointment_register_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Lalo
--

ALTER SEQUENCE appointment_register_id_seq OWNED BY appointment_register.id;


--
-- Name: days; Type: TABLE; Schema: public; Owner: Lalo
--

CREATE TABLE days (
    id integer NOT NULL,
    name character varying(20)
);


ALTER TABLE days OWNER TO "Lalo";

--
-- Name: days_id_seq; Type: SEQUENCE; Schema: public; Owner: Lalo
--

CREATE SEQUENCE days_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE days_id_seq OWNER TO "Lalo";

--
-- Name: days_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Lalo
--

ALTER SEQUENCE days_id_seq OWNED BY days.id;


--
-- Name: schedule; Type: TABLE; Schema: public; Owner: Lalo
--

CREATE TABLE schedule (
    id integer NOT NULL,
    begin_hour time without time zone,
    end_hour time without time zone,
    schedule_type integer,
    semester integer,
    subject integer,
    visible boolean,
    day integer,
    CONSTRAINT schedule_begin_hour_check CHECK ((begin_hour > '06:00:00'::time without time zone)),
    CONSTRAINT schedule_end_hour_check CHECK ((end_hour > '07:00:00'::time without time zone))
);


ALTER TABLE schedule OWNER TO "Lalo";

--
-- Name: schedule_id_seq; Type: SEQUENCE; Schema: public; Owner: Lalo
--

CREATE SEQUENCE schedule_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE schedule_id_seq OWNER TO "Lalo";

--
-- Name: schedule_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Lalo
--

ALTER SEQUENCE schedule_id_seq OWNED BY schedule.id;


--
-- Name: schedule_type; Type: TABLE; Schema: public; Owner: Lalo
--

CREATE TABLE schedule_type (
    id integer NOT NULL,
    name character varying(60)
);


ALTER TABLE schedule_type OWNER TO "Lalo";

--
-- Name: schedule_type_id_seq; Type: SEQUENCE; Schema: public; Owner: Lalo
--

CREATE SEQUENCE schedule_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE schedule_type_id_seq OWNER TO "Lalo";

--
-- Name: schedule_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Lalo
--

ALTER SEQUENCE schedule_type_id_seq OWNED BY schedule_type.id;


--
-- Name: semester; Type: TABLE; Schema: public; Owner: Lalo
--

CREATE TABLE semester (
    id integer NOT NULL,
    semester_type integer,
    year date
);


ALTER TABLE semester OWNER TO "Lalo";

--
-- Name: semester_id_seq; Type: SEQUENCE; Schema: public; Owner: Lalo
--

CREATE SEQUENCE semester_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE semester_id_seq OWNER TO "Lalo";

--
-- Name: semester_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Lalo
--

ALTER SEQUENCE semester_id_seq OWNED BY semester.id;


--
-- Name: semester_type; Type: TABLE; Schema: public; Owner: Lalo
--

CREATE TABLE semester_type (
    id integer NOT NULL,
    name character varying(60)
);


ALTER TABLE semester_type OWNER TO "Lalo";

--
-- Name: semester_type_id_seq; Type: SEQUENCE; Schema: public; Owner: Lalo
--

CREATE SEQUENCE semester_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE semester_type_id_seq OWNER TO "Lalo";

--
-- Name: semester_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Lalo
--

ALTER SEQUENCE semester_type_id_seq OWNED BY semester_type.id;


--
-- Name: student; Type: TABLE; Schema: public; Owner: Lalo
--

CREATE TABLE student (
    id integer NOT NULL,
    name character varying(60),
    last_name character varying(60),
    password character varying(60)
);


ALTER TABLE student OWNER TO "Lalo";

--
-- Name: student_id_seq; Type: SEQUENCE; Schema: public; Owner: Lalo
--

CREATE SEQUENCE student_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE student_id_seq OWNER TO "Lalo";

--
-- Name: student_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Lalo
--

ALTER SEQUENCE student_id_seq OWNED BY student.id;


--
-- Name: subject; Type: TABLE; Schema: public; Owner: Lalo
--

CREATE TABLE subject (
    id integer NOT NULL,
    name character varying(60)
);


ALTER TABLE subject OWNER TO "Lalo";

--
-- Name: subject_id_seq; Type: SEQUENCE; Schema: public; Owner: Lalo
--

CREATE SEQUENCE subject_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE subject_id_seq OWNER TO "Lalo";

--
-- Name: subject_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Lalo
--

ALTER SEQUENCE subject_id_seq OWNED BY subject.id;


--
-- Name: teacher; Type: TABLE; Schema: public; Owner: Lalo
--

CREATE TABLE teacher (
    id integer NOT NULL,
    name character varying(60),
    last_name character varying(60),
    password character varying(60)
);


ALTER TABLE teacher OWNER TO "Lalo";

--
-- Name: teacher_id_seq; Type: SEQUENCE; Schema: public; Owner: Lalo
--

CREATE SEQUENCE teacher_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE teacher_id_seq OWNER TO "Lalo";

--
-- Name: teacher_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Lalo
--

ALTER SEQUENCE teacher_id_seq OWNED BY teacher.id;


--
-- Name: teacher_schedule; Type: TABLE; Schema: public; Owner: Lalo
--

CREATE TABLE teacher_schedule (
    id integer NOT NULL,
    schedule integer,
    teacher integer
);


ALTER TABLE teacher_schedule OWNER TO "Lalo";

--
-- Name: teacher_schedule_id_seq; Type: SEQUENCE; Schema: public; Owner: Lalo
--

CREATE SEQUENCE teacher_schedule_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE teacher_schedule_id_seq OWNER TO "Lalo";

--
-- Name: teacher_schedule_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Lalo
--

ALTER SEQUENCE teacher_schedule_id_seq OWNED BY teacher_schedule.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: Lalo
--

CREATE TABLE users (
    id integer NOT NULL,
    username character varying(100),
    password character varying(100),
    created_at date DEFAULT ('now'::text)::date NOT NULL
);


ALTER TABLE users OWNER TO "Lalo";

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: Lalo
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO "Lalo";

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Lalo
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: view_appointment; Type: VIEW; Schema: public; Owner: Lalo
--

CREATE VIEW view_appointment AS
 SELECT student.name AS "Student",
    schedule.begin_hour AS "Start",
    schedule.end_hour AS "End",
    teacher.name AS "Teacher",
    subject.name AS "Subject",
    appointment.topic AS "Topic",
    appointment.day AS "Day"
   FROM ((((appointment
     JOIN student ON ((appointment.student = student.id)))
     JOIN schedule ON ((appointment.schedule = schedule.id)))
     JOIN teacher ON ((appointment.teacher = teacher.id)))
     JOIN subject ON ((appointment.subject = subject.id)));


ALTER TABLE view_appointment OWNER TO "Lalo";

--
-- Name: view_schedule; Type: VIEW; Schema: public; Owner: Lalo
--

CREATE VIEW view_schedule AS
 SELECT teacher.name AS "Teacher",
    schedule_type.name AS "Type of schedule",
    schedule.begin_hour AS "Start",
    schedule.end_hour AS "End",
    days.name AS "Day"
   FROM ((((teacher_schedule
     JOIN teacher ON ((teacher_schedule.teacher = teacher.id)))
     JOIN schedule ON ((teacher_schedule.schedule = schedule.id)))
     JOIN schedule_type ON ((schedule.schedule_type = schedule_type.id)))
     JOIN days ON ((schedule.day = days.id)));


ALTER TABLE view_schedule OWNER TO "Lalo";

--
-- Name: view_schedule_avaliable; Type: VIEW; Schema: public; Owner: Lalo
--

CREATE VIEW view_schedule_avaliable AS
 SELECT schedule.id AS "Id",
    teacher.id AS "Teacher",
    schedule.schedule_type AS "Type",
    schedule.begin_hour AS "Start",
    schedule.end_hour AS "End",
    schedule.day AS "DayId",
    days.name AS "Day"
   FROM (((teacher_schedule
     JOIN teacher ON ((teacher_schedule.teacher = teacher.id)))
     JOIN schedule ON ((teacher_schedule.schedule = schedule.id)))
     JOIN days ON ((schedule.day = days.id)))
  WHERE ((schedule.schedule_type = 2) OR (schedule.schedule_type = 3));


ALTER TABLE view_schedule_avaliable OWNER TO "Lalo";

--
-- Name: view_schedule_id; Type: VIEW; Schema: public; Owner: Lalo
--

CREATE VIEW view_schedule_id AS
 SELECT teacher.id AS "Id",
    schedule_type.name AS "Type",
    schedule.begin_hour AS "Start",
    schedule.end_hour AS "End",
    days.name AS "Day"
   FROM ((((teacher_schedule
     JOIN teacher ON ((teacher_schedule.teacher = teacher.id)))
     JOIN schedule ON ((teacher_schedule.schedule = schedule.id)))
     JOIN schedule_type ON ((schedule.schedule_type = schedule_type.id)))
     JOIN days ON ((schedule.day = days.id)))
  ORDER BY days.id;


ALTER TABLE view_schedule_id OWNER TO "Lalo";

--
-- Name: view_semester; Type: VIEW; Schema: public; Owner: Lalo
--

CREATE VIEW view_semester AS
 SELECT semester_type.name AS "Period",
    semester.year AS "Year"
   FROM (semester
     JOIN semester_type ON ((semester.semester_type = semester_type.id)));


ALTER TABLE view_semester OWNER TO "Lalo";

--
-- Name: appointment id; Type: DEFAULT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY appointment ALTER COLUMN id SET DEFAULT nextval('appointment_id_seq'::regclass);


--
-- Name: appointment_register id; Type: DEFAULT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY appointment_register ALTER COLUMN id SET DEFAULT nextval('appointment_register_id_seq'::regclass);


--
-- Name: days id; Type: DEFAULT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY days ALTER COLUMN id SET DEFAULT nextval('days_id_seq'::regclass);


--
-- Name: schedule id; Type: DEFAULT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY schedule ALTER COLUMN id SET DEFAULT nextval('schedule_id_seq'::regclass);


--
-- Name: schedule_type id; Type: DEFAULT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY schedule_type ALTER COLUMN id SET DEFAULT nextval('schedule_type_id_seq'::regclass);


--
-- Name: semester id; Type: DEFAULT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY semester ALTER COLUMN id SET DEFAULT nextval('semester_id_seq'::regclass);


--
-- Name: semester_type id; Type: DEFAULT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY semester_type ALTER COLUMN id SET DEFAULT nextval('semester_type_id_seq'::regclass);


--
-- Name: student id; Type: DEFAULT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY student ALTER COLUMN id SET DEFAULT nextval('student_id_seq'::regclass);


--
-- Name: subject id; Type: DEFAULT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY subject ALTER COLUMN id SET DEFAULT nextval('subject_id_seq'::regclass);


--
-- Name: teacher id; Type: DEFAULT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY teacher ALTER COLUMN id SET DEFAULT nextval('teacher_id_seq'::regclass);


--
-- Name: teacher_schedule id; Type: DEFAULT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY teacher_schedule ALTER COLUMN id SET DEFAULT nextval('teacher_schedule_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Data for Name: appointment; Type: TABLE DATA; Schema: public; Owner: Lalo
--

COPY appointment (id, student, schedule, teacher, subject, topic, day) FROM stdin;
1	1	2	3	2	Views en postgres	2017-02-10
2	3	11	4	6	Static Routing	2017-03-05
3	4	8	3	1	Derivatives	2017-03-15
4	2	14	7	5	Maps in Xcode	2017-02-16
5	6	5	5	4	Testing java	2017-02-10
6	5	11	6	3	Vectorial Spaces	2017-02-10
7	1	1	1	1	Problemas de matematicas	2017-05-05
\.


--
-- Name: appointment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Lalo
--

SELECT pg_catalog.setval('appointment_id_seq', 7, true);


--
-- Data for Name: appointment_register; Type: TABLE DATA; Schema: public; Owner: Lalo
--

COPY appointment_register (id, appointment, date) FROM stdin;
1	7	2017-03-06 20:09:57.46384
\.


--
-- Name: appointment_register_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Lalo
--

SELECT pg_catalog.setval('appointment_register_id_seq', 1, true);


--
-- Data for Name: days; Type: TABLE DATA; Schema: public; Owner: Lalo
--

COPY days (id, name) FROM stdin;
1	Sunday
2	Monday
3	Tuesday
4	Wednesday
5	Thursday
6	Friday
7	Saturday
\.


--
-- Name: days_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Lalo
--

SELECT pg_catalog.setval('days_id_seq', 7, true);


--
-- Data for Name: schedule; Type: TABLE DATA; Schema: public; Owner: Lalo
--

COPY schedule (id, begin_hour, end_hour, schedule_type, semester, subject, visible, day) FROM stdin;
4	08:00:00	09:30:00	1	3	2	t	2
6	16:00:00	17:30:00	3	3	2	t	2
8	09:00:00	10:30:00	2	3	2	t	2
2	12:30:00	14:00:00	2	3	2	t	3
5	10:00:00	11:30:00	2	3	2	t	3
10	07:00:00	08:30:00	1	3	2	t	3
15	10:00:00	11:30:00	3	3	2	t	5
7	17:00:00	18:30:00	1	3	2	t	4
13	14:00:00	15:30:00	1	3	2	t	4
9	10:30:00	12:30:00	3	3	2	t	3
12	18:00:00	17:30:00	3	3	2	t	2
14	17:00:00	18:30:00	2	3	2	t	6
11	08:30:00	10:00:00	2	3	2	t	6
1	11:00:00	12:30:00	1	3	2	t	6
3	14:00:00	15:30:00	3	3	2	t	6
\.


--
-- Name: schedule_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Lalo
--

SELECT pg_catalog.setval('schedule_id_seq', 15, true);


--
-- Data for Name: schedule_type; Type: TABLE DATA; Schema: public; Owner: Lalo
--

COPY schedule_type (id, name) FROM stdin;
1	Classes
2	Tutoring
3	Possible tutoring
\.


--
-- Name: schedule_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Lalo
--

SELECT pg_catalog.setval('schedule_type_id_seq', 3, true);


--
-- Data for Name: semester; Type: TABLE DATA; Schema: public; Owner: Lalo
--

COPY semester (id, semester_type, year) FROM stdin;
1	3	2016-01-01
2	2	2016-01-01
3	1	2017-01-01
\.


--
-- Name: semester_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Lalo
--

SELECT pg_catalog.setval('semester_id_seq', 3, true);


--
-- Data for Name: semester_type; Type: TABLE DATA; Schema: public; Owner: Lalo
--

COPY semester_type (id, name) FROM stdin;
1	Enero - Mayo
2	Verano
3	Agosto - Diciembre
\.


--
-- Name: semester_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Lalo
--

SELECT pg_catalog.setval('semester_type_id_seq', 3, true);


--
-- Data for Name: student; Type: TABLE DATA; Schema: public; Owner: Lalo
--

COPY student (id, name, last_name, password) FROM stdin;
1	Eduardo	Luna	secret
2	Jota Pe	Flores	secret
3	Joel	Ramirez	secret
4	Jesus	Miron	secret
5	Julian	Huerta	secret
6	Enrique	Lozada	secret
7	Alejandro	Tovar	secret
8	Fany	Pitol	secret
9	Fernanda	Montanio	secret
\.


--
-- Name: student_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Lalo
--

SELECT pg_catalog.setval('student_id_seq', 9, true);


--
-- Data for Name: subject; Type: TABLE DATA; Schema: public; Owner: Lalo
--

COPY subject (id, name) FROM stdin;
1	Math
2	Data Bases
3	Linear Algebra
4	Quality of Software
5	Devices
6	Networks
\.


--
-- Name: subject_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Lalo
--

SELECT pg_catalog.setval('subject_id_seq', 6, true);


--
-- Data for Name: teacher; Type: TABLE DATA; Schema: public; Owner: Lalo
--

COPY teacher (id, name, last_name, password) FROM stdin;
1	Manuel	Calleros	secret
2	Daniel	Perez	secret
3	Alvaro	Andrade	secret
5	Gilberto	Hernandez	secret
6	Erika	Ramirez	secret
7	Soledad	Rios	secret
4	Abel	Odiado	secret
\.


--
-- Name: teacher_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Lalo
--

SELECT pg_catalog.setval('teacher_id_seq', 7, true);


--
-- Data for Name: teacher_schedule; Type: TABLE DATA; Schema: public; Owner: Lalo
--

COPY teacher_schedule (id, schedule, teacher) FROM stdin;
1	1	1
2	2	1
3	3	1
4	4	2
5	5	2
6	6	2
7	7	3
8	8	3
9	9	3
10	10	4
11	11	4
12	12	4
13	13	5
14	14	5
15	15	5
16	10	6
17	11	6
18	12	6
19	13	7
20	14	7
21	15	7
\.


--
-- Name: teacher_schedule_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Lalo
--

SELECT pg_catalog.setval('teacher_schedule_id_seq', 21, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: Lalo
--

COPY users (id, username, password, created_at) FROM stdin;
1	user0	secret	2017-03-03
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Lalo
--

SELECT pg_catalog.setval('users_id_seq', 1, true);


--
-- Name: appointment appointment_pkey; Type: CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY appointment
    ADD CONSTRAINT appointment_pkey PRIMARY KEY (id);


--
-- Name: appointment_register appointment_register_pkey; Type: CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY appointment_register
    ADD CONSTRAINT appointment_register_pkey PRIMARY KEY (id);


--
-- Name: days days_pkey; Type: CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY days
    ADD CONSTRAINT days_pkey PRIMARY KEY (id);


--
-- Name: schedule schedule_pkey; Type: CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY schedule
    ADD CONSTRAINT schedule_pkey PRIMARY KEY (id);


--
-- Name: schedule_type schedule_type_pkey; Type: CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY schedule_type
    ADD CONSTRAINT schedule_type_pkey PRIMARY KEY (id);


--
-- Name: semester semester_pkey; Type: CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY semester
    ADD CONSTRAINT semester_pkey PRIMARY KEY (id);


--
-- Name: semester_type semester_type_pkey; Type: CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY semester_type
    ADD CONSTRAINT semester_type_pkey PRIMARY KEY (id);


--
-- Name: student student_pkey; Type: CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY student
    ADD CONSTRAINT student_pkey PRIMARY KEY (id);


--
-- Name: subject subject_pkey; Type: CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY subject
    ADD CONSTRAINT subject_pkey PRIMARY KEY (id);


--
-- Name: teacher teacher_pkey; Type: CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY teacher
    ADD CONSTRAINT teacher_pkey PRIMARY KEY (id);


--
-- Name: teacher_schedule teacher_schedule_pkey; Type: CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY teacher_schedule
    ADD CONSTRAINT teacher_schedule_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: appointment register_appointment; Type: TRIGGER; Schema: public; Owner: Lalo
--

CREATE TRIGGER register_appointment AFTER INSERT ON appointment FOR EACH ROW EXECUTE PROCEDURE appointment_insert();


--
-- Name: appointment_register appointment_register_appointment_fkey; Type: FK CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY appointment_register
    ADD CONSTRAINT appointment_register_appointment_fkey FOREIGN KEY (appointment) REFERENCES appointment(id);


--
-- Name: appointment appointment_schedule_fkey; Type: FK CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY appointment
    ADD CONSTRAINT appointment_schedule_fkey FOREIGN KEY (schedule) REFERENCES schedule(id);


--
-- Name: appointment appointment_student_fkey; Type: FK CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY appointment
    ADD CONSTRAINT appointment_student_fkey FOREIGN KEY (student) REFERENCES student(id);


--
-- Name: appointment appointment_subject_fkey; Type: FK CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY appointment
    ADD CONSTRAINT appointment_subject_fkey FOREIGN KEY (subject) REFERENCES subject(id);


--
-- Name: appointment appointment_teacher_fkey; Type: FK CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY appointment
    ADD CONSTRAINT appointment_teacher_fkey FOREIGN KEY (teacher) REFERENCES teacher(id);


--
-- Name: schedule schedule_day_fkey; Type: FK CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY schedule
    ADD CONSTRAINT schedule_day_fkey FOREIGN KEY (day) REFERENCES days(id);


--
-- Name: schedule schedule_schedule_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY schedule
    ADD CONSTRAINT schedule_schedule_type_fkey FOREIGN KEY (schedule_type) REFERENCES schedule_type(id);


--
-- Name: schedule schedule_semester_fkey; Type: FK CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY schedule
    ADD CONSTRAINT schedule_semester_fkey FOREIGN KEY (semester) REFERENCES semester(id);


--
-- Name: schedule schedule_subject_fkey; Type: FK CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY schedule
    ADD CONSTRAINT schedule_subject_fkey FOREIGN KEY (subject) REFERENCES schedule(id);


--
-- Name: semester semester_semester_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY semester
    ADD CONSTRAINT semester_semester_type_fkey FOREIGN KEY (semester_type) REFERENCES semester_type(id);


--
-- Name: teacher_schedule teacher_schedule_schedule_fkey; Type: FK CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY teacher_schedule
    ADD CONSTRAINT teacher_schedule_schedule_fkey FOREIGN KEY (schedule) REFERENCES schedule(id);


--
-- Name: teacher_schedule teacher_schedule_teacher_fkey; Type: FK CONSTRAINT; Schema: public; Owner: Lalo
--

ALTER TABLE ONLY teacher_schedule
    ADD CONSTRAINT teacher_schedule_teacher_fkey FOREIGN KEY (teacher) REFERENCES teacher(id);


--
-- PostgreSQL database dump complete
--

