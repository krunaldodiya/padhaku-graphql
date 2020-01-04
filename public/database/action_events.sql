-- -------------------------------------------------------------
-- TablePlus 2.10(270)
--
-- https://tableplus.com/
--
-- Database: pauzr
-- Generation Time: 2020-01-04 08:38:24.6880
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "public"."action_events";
-- This script only contains the table creation statements and does not fully represent the table in the database. It's still missing: indices, triggers. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS action_events_id_seq;

-- Table Definition
CREATE TABLE "public"."action_events" (
    "id" int8 NOT NULL DEFAULT nextval('action_events_id_seq'::regclass),
    "batch_id" bpchar NOT NULL,
    "user_id" uuid NOT NULL,
    "name" varchar(255) NOT NULL,
    "actionable_type" varchar(255) NOT NULL,
    "actionable_id" uuid NOT NULL,
    "target_type" varchar(255) NOT NULL,
    "target_id" uuid NOT NULL,
    "model_type" varchar(255) NOT NULL,
    "model_id" uuid,
    "fields" text NOT NULL,
    "status" varchar(25) NOT NULL DEFAULT 'running'::character varying,
    "exception" text NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "original" text,
    "changes" text,
    PRIMARY KEY ("id")
);

INSERT INTO "public"."action_events" ("id", "batch_id", "user_id", "name", "actionable_type", "actionable_id", "target_type", "target_id", "model_type", "model_id", "fields", "status", "exception", "created_at", "updated_at", "original", "changes") VALUES ('1', '8f2f174e-39ae-4d31-b25b-cd90572c20ca', 'ca55bf22-8440-4771-8fa5-42401e163fe0', 'Create', 'App\Category', '7a70d417-cf69-41d8-950e-6f6ed071d7a1', 'App\Category', '7a70d417-cf69-41d8-950e-6f6ed071d7a1', 'App\Category', '7a70d417-cf69-41d8-950e-6f6ed071d7a1', '', 'finished', '', '2019-11-21 08:16:12', '2019-11-21 08:16:12', NULL, '{"name":"general","background_image":"q6XbCDZZe0Ls8PysX465c6pFa9c5hcSgL2a9dbZ7.jpeg","background_color":"red","id":"7a70d417-cf69-41d8-950e-6f6ed071d7a1"}');
