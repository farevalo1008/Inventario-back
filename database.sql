CREATE DATABASE IF NOT EXISTS soaintranet;
USE soaintranet:

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

CREATE TABLE public.users
(
  id bigint NOT NULL DEFAULT nextval('users_id_seq'::regclass),
  email character varying(255) NOT NULL,
  password character varying(255) NOT NULL,
  remember_token character varying(255),
  created_at timestamp without time zone NOT NULL DEFAULT now(),
  updated_at timestamp without time zone,
  rol integer,
  CONSTRAINT pk_user_id PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.users
  OWNER TO postgres;