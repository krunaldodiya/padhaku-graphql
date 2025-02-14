-- -------------------------------------------------------------
-- TablePlus 2.10(270)
--
-- https://tableplus.com/
--
-- Database: padhakoo
-- Generation Time: 2020-01-04 10:21:14.5230
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "public"."categories";
-- This script only contains the table creation statements and does not fully represent the table in the database. It's still missing: indices, triggers. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."categories" (
    "id" uuid NOT NULL,
    "name" varchar(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    PRIMARY KEY ("id")
);

INSERT INTO "public"."categories" ("id", "name", "created_at", "updated_at") VALUES ('02d0ea88-9786-44ca-8f23-0e1a2e3f4f5c', 'Earth', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('04f544a0-8614-4437-90b3-6ef5cc80658e', 'Lodi and Sayyid Dynasty', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('06b8467e-4223-41ac-b474-245cbdf7e2f2', 'General Science', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('08793090-b5cd-44c3-8b65-d7a4ab4a28f5', 'Awards and Honours', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('0ac41b2e-7ed1-4540-94d3-505f584916ae', 'World History', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('0b6845ba-481d-4665-80e2-86ee65ceb0a4', 'Indian Economy', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('0dfbbf85-d9b2-45ed-87e1-132171062609', 'Chemistry', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('15c1b592-c80d-4ba1-a484-5c8539f36e6c', 'Mauryan Empire', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('1fcecba7-7d77-4bcb-b95a-9ef7439bc0c1', 'Technology', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('20a1a9eb-ab15-4119-9a83-685429c10f64', 'Indian Culture', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('24e028a5-b6ed-45c1-a9a0-f90e5875fb12', 'World Organisations', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('26aaa237-f53e-4511-86dd-486d6d9ad4c6', 'Agriculture and Soil in Indian Geography', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('28656837-77b5-458b-831f-6a44b9dd9b64', 'Sports', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('2983fc44-bd19-4bdf-b151-ee14ba86a33a', 'Indus Valley Civilisation', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('2998866d-659c-43b0-ac3b-f4f23d334ad2', 'Universe', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('2a2a7033-8a1a-40ab-9d04-76c75e26c4d4', 'Famous Personalities', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('2b835def-09d6-4e7a-8a2a-ffe964bd36c3', 'Hydrosphere', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('2ccbe624-ff86-4fc8-80ab-512761a6218d', 'Miscellaneous World Geography', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('31921887-e83c-4659-8c25-21d1627f4d35', 'Lithosphere', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('31e6c860-456b-422e-944e-98b3095d5c16', 'Inventions', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('3283f9d1-5b71-4ea4-adba-0e9805617e83', 'Tally', '2019-03-14 11:49:09', '2020-01-04 04:05:32'),
('364a5481-48f0-4599-93b3-a3a0342d274a', 'Computer Fundamental', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('3c3e23a1-1868-4904-aadc-619af5512fab', 'Vedic Age', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('3f1b6414-2014-4358-a277-b8e5b7ece248', 'Miscellaneous Indian Geography', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('45f39d59-efb8-4ac4-b2d3-2b965d19788c', 'World Geography', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('51f63c88-c00b-4b50-8da0-af8499cd12c5', 'Maratha Empire', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('56351627-5680-46ff-b80f-86f89505883d', 'Computer Fundamental Miscellaneous', '2019-03-14 11:49:09', '2020-01-04 04:05:32'),
('56ac5bba-55be-40f4-9707-a20358ec6d86', 'Indian Rivers, Lakes and Water', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('59714eb9-0c75-4cb9-803e-52f57bcfc940', 'Geography', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('59de3a9e-dd61-4352-9416-6a5f09c594c5', '18th Century Revolts and Reform', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('5af10c8d-94fa-4ac1-81c4-ff061e19e90c', 'World Climate and Weather', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('6bb6b959-1864-4fbb-ad85-cc24b6853fe0', 'Bhakti Movement', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('6bf32c8d-27b6-4b55-b81a-58412fb755f1', 'Physics', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('6c91a05e-fd33-438a-bd6d-c9e409e04ab6', 'Modern Indian History', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('6ed660e6-8c95-4ad1-8aa8-201b98ddaee4', 'Magadha Empire', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('7252ec94-d87e-4159-9e96-e8f99acbeee4', 'Mughal Empire', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('74b3612a-acf6-4fd7-bdcc-c34f19c295d4', 'World Environment and Ecology', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('75384181-5715-4988-84fc-86825cc434a8', 'Medieval History Art and Culture', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('7b4e83a7-fa21-4d60-854b-18e054ed3433', 'Indian Geography', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('7e78e006-12c0-4a28-ae94-2498c0bf14aa', 'Struggle for Independence of India', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('81363a99-f2c1-4988-aebd-41f157b42060', 'Transportation system of India', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('84b661d9-6704-45ee-ab28-cab822fd5165', 'Famous Places in India', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('87c8af3f-4a6e-4c1b-8184-ff7ca32c9fec', 'Atmosphere', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('88c11438-8d10-472e-a72c-f688c1fb7221', 'History', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('89357d17-2544-47ac-aaa1-29b47b58c6b6', 'Deccan Dynasties and Sangam Dynasty', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('8ca4e6a5-510b-4b8f-af82-94352553a5d3', 'Climate and Weather in Indian Geography', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('95c90713-58f5-49fd-a55a-41b312cbbae1', 'World Agriculture, Minerals and Industries', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('95d6a30b-e88b-4b78-a2f5-7f978e132d4b', 'Days and Years', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('a0b547f5-bea5-4153-8899-4653e6eb862d', 'Sikh Empire', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('a0cca5e0-89f1-446f-8979-b825bb0df3fb', 'Tughlaq Dynasty', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('a5f234bd-0a1b-4e7c-bcbd-50ef8f577e32', 'Books and Authors', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('a7b011e1-4e96-4740-bb3f-80056265d181', 'Indian History', '2019-03-14 11:34:34', '2020-01-04 04:05:32'),
('abcae8e7-7b38-4a4a-a0ec-ab04ebff5736', 'Harshavardhana Empire', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('ac1a0e0b-5977-4956-9a44-adfae433b890', 'Natural Resources and Industries in Indian Geography', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('ae464b0b-6264-46ec-ab64-2a1ac6ed4952', 'MS Excel', '2019-03-14 11:49:09', '2020-01-04 04:05:32'),
('b37d3234-c268-417c-adab-4633269b77d8', 'Gulam Dynasty', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('c4d5a655-896b-40d1-9815-6ba90b8fbbb7', 'British Rule in India', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('c628a07c-9d79-4f7c-8a27-95a1a60c4c6f', 'Khalji Dynasty', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('c89e4a63-309b-468d-84b0-dcf5a7c02e54', 'Biology', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('d00ce9e0-d3b1-4658-8a43-8ad81d6028a2', 'Environmental Science', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('d0b8a89b-d0ee-4034-bf69-ddcc647b927a', 'Basic General Knowledge', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('d7d3e1f0-dd99-44cb-9d9c-f1a7e6926bb9', 'Environment and Ecology in Indian Geography', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('d7ec28af-c78f-4be1-afa3-9616b4658164', 'Indian Politics', '2019-03-14 11:31:34', '2020-01-04 04:05:32'),
('dda576d3-3cf6-49b9-8f31-d877447b64ab', 'Ancient History Art and Culture', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('e1343dc8-3fcb-4588-9221-ded4ef509851', 'Political Geography of India', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('e49f4bdd-0bf8-4241-9518-d31d81ad001d', 'Population and Tribes in Indian Geography', '2019-03-14 11:42:06', '2020-01-04 04:05:32'),
('e52b25db-ab5c-4148-8242-20ec4fca1e21', 'Jainism and Buddhism', '2019-03-14 11:38:45', '2020-01-04 04:05:32'),
('e6335942-8b03-460e-bd5d-0ee9b9d4f5b6', 'Operating System', '2019-03-14 11:49:09', '2020-01-04 04:05:32'),
('e8037225-f828-4429-91f2-f0eb27b68a55', 'Power Point', '2019-03-14 11:49:09', '2020-01-04 04:05:32'),
('eeaefbb5-1044-4294-9749-6190dc577244', 'MS Word', '2019-03-14 11:49:09', '2020-01-04 04:05:32'),
('f22aa3a1-1a6e-4e3d-ba3f-c90cabdc19d6', 'GK', '2019-03-14 11:31:15', '2020-01-04 04:05:32');
