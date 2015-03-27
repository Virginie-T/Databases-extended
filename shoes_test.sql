--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: brands; Type: TABLE; Schema: public; Owner: VirginieT; Tablespace: 
--

CREATE TABLE brands (
    id integer NOT NULL,
    name character varying
);


ALTER TABLE brands OWNER TO "VirginieT";

--
-- Name: brands_id_seq; Type: SEQUENCE; Schema: public; Owner: VirginieT
--

CREATE SEQUENCE brands_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE brands_id_seq OWNER TO "VirginieT";

--
-- Name: brands_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: VirginieT
--

ALTER SEQUENCE brands_id_seq OWNED BY brands.id;


--
-- Name: brands_stores; Type: TABLE; Schema: public; Owner: VirginieT; Tablespace: 
--

CREATE TABLE brands_stores (
    id integer NOT NULL,
    brand_id integer,
    store_id integer
);


ALTER TABLE brands_stores OWNER TO "VirginieT";

--
-- Name: brands_stores_id_seq; Type: SEQUENCE; Schema: public; Owner: VirginieT
--

CREATE SEQUENCE brands_stores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE brands_stores_id_seq OWNER TO "VirginieT";

--
-- Name: brands_stores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: VirginieT
--

ALTER SEQUENCE brands_stores_id_seq OWNED BY brands_stores.id;


--
-- Name: stores; Type: TABLE; Schema: public; Owner: VirginieT; Tablespace: 
--

CREATE TABLE stores (
    id integer NOT NULL,
    name character varying
);


ALTER TABLE stores OWNER TO "VirginieT";

--
-- Name: stores_id_seq; Type: SEQUENCE; Schema: public; Owner: VirginieT
--

CREATE SEQUENCE stores_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE stores_id_seq OWNER TO "VirginieT";

--
-- Name: stores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: VirginieT
--

ALTER SEQUENCE stores_id_seq OWNED BY stores.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: VirginieT
--

ALTER TABLE ONLY brands ALTER COLUMN id SET DEFAULT nextval('brands_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: VirginieT
--

ALTER TABLE ONLY brands_stores ALTER COLUMN id SET DEFAULT nextval('brands_stores_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: VirginieT
--

ALTER TABLE ONLY stores ALTER COLUMN id SET DEFAULT nextval('stores_id_seq'::regclass);


--
-- Data for Name: brands; Type: TABLE DATA; Schema: public; Owner: VirginieT
--

COPY brands (id, name) FROM stdin;
125	Vans
126	Converse
127	Nike
128	brand 1
129	brand 1
130	Array
131	super brand
\.


--
-- Name: brands_id_seq; Type: SEQUENCE SET; Schema: public; Owner: VirginieT
--

SELECT pg_catalog.setval('brands_id_seq', 131, true);


--
-- Data for Name: brands_stores; Type: TABLE DATA; Schema: public; Owner: VirginieT
--

COPY brands_stores (id, brand_id, store_id) FROM stdin;
1	4	1
2	5	1
3	11	4
4	12	4
5	17	6
6	18	6
7	19	7
8	23	8
9	24	8
10	25	9
11	29	10
12	30	10
13	31	11
14	35	12
15	36	12
16	37	13
17	41	14
18	42	14
19	43	15
20	47	16
21	48	16
22	49	17
23	53	18
24	54	18
25	55	19
26	59	20
27	60	20
28	61	21
29	65	22
30	66	22
31	67	23
32	68	27
33	69	27
34	70	28
35	74	29
36	75	29
37	76	30
38	77	34
39	78	34
40	79	35
41	83	36
42	84	36
43	85	37
44	86	41
45	87	41
46	88	42
47	92	43
48	93	43
49	94	44
50	95	48
51	96	48
52	97	49
53	101	50
54	102	50
55	103	51
56	104	55
57	105	55
58	106	56
59	110	57
60	111	57
61	112	58
62	113	62
63	114	62
64	115	63
65	119	64
66	120	64
67	121	65
68	122	69
69	123	69
70	124	70
71	128	72
72	129	72
73	128	74
\.


--
-- Name: brands_stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: VirginieT
--

SELECT pg_catalog.setval('brands_stores_id_seq', 73, true);


--
-- Data for Name: stores; Type: TABLE DATA; Schema: public; Owner: VirginieT
--

COPY stores (id, name) FROM stdin;
101	yop
\.


--
-- Name: stores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: VirginieT
--

SELECT pg_catalog.setval('stores_id_seq', 105, true);


--
-- Name: brands_pkey; Type: CONSTRAINT; Schema: public; Owner: VirginieT; Tablespace: 
--

ALTER TABLE ONLY brands
    ADD CONSTRAINT brands_pkey PRIMARY KEY (id);


--
-- Name: brands_stores_pkey; Type: CONSTRAINT; Schema: public; Owner: VirginieT; Tablespace: 
--

ALTER TABLE ONLY brands_stores
    ADD CONSTRAINT brands_stores_pkey PRIMARY KEY (id);


--
-- Name: stores_pkey; Type: CONSTRAINT; Schema: public; Owner: VirginieT; Tablespace: 
--

ALTER TABLE ONLY stores
    ADD CONSTRAINT stores_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: VirginieT
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM "VirginieT";
GRANT ALL ON SCHEMA public TO "VirginieT";
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

