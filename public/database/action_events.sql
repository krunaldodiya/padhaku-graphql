-- -------------------------------------------------------------
-- TablePlus 3.1.2(296)
--
-- https://tableplus.com/
--
-- Database: learning
-- Generation Time: 2020-03-07 08:59:24.1490
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

