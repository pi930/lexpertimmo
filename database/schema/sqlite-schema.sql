CREATE TABLE IF NOT EXISTS "migrations"(
  "id" integer primary key autoincrement not null,
  "migration" varchar not null,
  "batch" integer not null
);
CREATE TABLE IF NOT EXISTS "users"(
  "id" integer primary key autoincrement not null,
  "role" varchar not null default 'User',
  "nom" varchar not null,
  "rue" varchar,
  "code_postal" varchar,
  "ville" varchar,
  "pays" varchar,
  "phone" varchar,
  "email" varchar not null,
  "email_verified_at" datetime,
  "password" varchar not null,
  "remember_token" varchar,
  "created_at" datetime,
  "updated_at" datetime,
  "adresse" varchar,
  "latitude" numeric,
  "longitude" numeric
);
CREATE UNIQUE INDEX "users_email_unique" on "users"("email");
CREATE TABLE IF NOT EXISTS "password_reset_tokens"(
  "email" varchar not null,
  "token" varchar not null,
  "created_at" datetime,
  primary key("email")
);
CREATE TABLE IF NOT EXISTS "sessions"(
  "id" varchar not null,
  "user_id" integer,
  "ip_address" varchar,
  "user_agent" text,
  "payload" text not null,
  "last_activity" integer not null,
  primary key("id")
);
CREATE INDEX "sessions_user_id_index" on "sessions"("user_id");
CREATE INDEX "sessions_last_activity_index" on "sessions"("last_activity");
CREATE TABLE IF NOT EXISTS "cache"(
  "key" varchar not null,
  "value" text not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "cache_locks"(
  "key" varchar not null,
  "owner" varchar not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "jobs"(
  "id" integer primary key autoincrement not null,
  "queue" varchar not null,
  "payload" text not null,
  "attempts" integer not null,
  "reserved_at" integer,
  "available_at" integer not null,
  "created_at" integer not null
);
CREATE INDEX "jobs_queue_index" on "jobs"("queue");
CREATE TABLE IF NOT EXISTS "job_batches"(
  "id" varchar not null,
  "name" varchar not null,
  "total_jobs" integer not null,
  "pending_jobs" integer not null,
  "failed_jobs" integer not null,
  "failed_job_ids" text not null,
  "options" text,
  "cancelled_at" integer,
  "created_at" integer not null,
  "finished_at" integer,
  primary key("id")
);
CREATE TABLE IF NOT EXISTS "failed_jobs"(
  "id" integer primary key autoincrement not null,
  "uuid" varchar not null,
  "connection" text not null,
  "queue" text not null,
  "payload" text not null,
  "exception" text not null,
  "failed_at" datetime not null default CURRENT_TIMESTAMP
);
CREATE UNIQUE INDEX "failed_jobs_uuid_unique" on "failed_jobs"("uuid");
CREATE TABLE IF NOT EXISTS "contacts"(
  "id" integer primary key autoincrement not null,
  "nom" varchar not null,
  "email" varchar not null,
  "telephone" varchar,
  "rue" varchar not null,
  "code_postal" varchar not null,
  "ville" varchar not null,
  "pays" varchar not null,
  "sujet" varchar not null,
  "message" text not null,
  "user_id" integer,
  "created_at" datetime,
  "updated_at" datetime,
  "reponse" text,
  foreign key("user_id") references "users"("id") on delete set null
);
CREATE TABLE IF NOT EXISTS "devis"(
  "id" integer primary key autoincrement not null,
  "user_id" integer,
  "reference" varchar,
  "total_ttc" numeric not null,
  "expires_at" datetime,
  "status" varchar check("status" in('en attente', 'validé', 'ticket')) not null default 'en attente',
  "nom" varchar,
  "email" varchar,
  "telephone" varchar,
  "message" text,
  "created_at" datetime,
  "updated_at" datetime,
  "pdf_path" varchar,
  "heures_travail" integer not null default '0',
  "zone_id" integer not null default '0',
  "adresse" varchar,
  "latitude" numeric,
  "longitude" numeric,
  foreign key("user_id") references "users"("id") on delete cascade
);
CREATE INDEX "devis_user_id_status_index" on "devis"("user_id", "status");
CREATE UNIQUE INDEX "devis_reference_unique" on "devis"("reference");
CREATE TABLE IF NOT EXISTS "prestations"(
  "id" integer primary key autoincrement not null,
  "titre" varchar not null,
  "description" text,
  "prix" numeric not null,
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "admin_notifications"(
  "id" integer primary key autoincrement not null,
  "admin_id" integer not null,
  "type" varchar not null,
  "content" text not null,
  "url" varchar,
  "read" tinyint(1) not null default '0',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("admin_id") references "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "objets"(
  "id" integer primary key autoincrement not null,
  "nom" varchar not null,
  "description" text,
  "prix_unitaire_ht" numeric not null,
  "tva" numeric not null,
  "created_at" datetime,
  "updated_at" datetime
);
CREATE TABLE IF NOT EXISTS "devis_lignes"(
  "id" integer primary key autoincrement not null,
  "devis_id" integer not null,
  "objet_id" integer,
  "designation" varchar not null,
  "quantite" integer not null default '1',
  "prix_unitaire_ht" numeric not null,
  "tva" numeric not null default '0',
  "total_ttc" numeric not null,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("devis_id") references "devis"("id") on delete cascade,
  foreign key("objet_id") references "objets"("id") on delete set null
);
CREATE TABLE IF NOT EXISTS "messages"(
  "id" integer primary key autoincrement not null,
  "user_id" integer not null,
  "content" text not null,
  "read" tinyint(1) not null default '0',
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("user_id") references "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "zones"(
  "id" integer primary key autoincrement not null,
  "created_at" datetime,
  "updated_at" datetime,
  "nom" varchar not null,
  "latitude" numeric not null,
  "longitude" numeric not null,
  "rayon_km" integer not null
);
CREATE TABLE IF NOT EXISTS "devis_prestations"(
  "id" integer primary key autoincrement not null,
  "devis_id" integer not null,
  "prestation_id" integer not null,
  "quantite" integer not null default '1',
  "prix_unitaire_ht" numeric not null,
  "tva" numeric not null default '20',
  "total_ttc" numeric not null,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("devis_id") references "devis"("id") on delete cascade,
  foreign key("prestation_id") references "prestations"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "rendezvous"(
  "id" integer primary key autoincrement not null,
  "user_id" integer,
  "date" datetime not null,
  "statut" varchar not null default 'en_attente',
  "notes" text,
  "zone" varchar,
  "travail_heure" integer,
  "bloque" tinyint(1) not null default '0',
  "rue" varchar,
  "code_postal" varchar,
  "ville" varchar,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("user_id") references "users"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "coordonnees"(
  "id" integer primary key autoincrement not null,
  "nom" varchar,
  "rue" varchar not null,
  "code_postal" varchar not null,
  "ville" varchar not null,
  "pays" varchar not null,
  "telephone" varchar,
  "email" varchar not null,
  "user_id" integer not null,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("user_id") references users("id") on delete cascade on update no action
);
CREATE TABLE IF NOT EXISTS "notifications"(
  "id" varchar not null,
  "admin_id" integer not null,
  "type" varchar not null,
  "notifiable_type" varchar not null,
  "notifiable_id" integer not null,
  "data" text not null,
  "read_at" datetime,
  "created_at" datetime,
  "updated_at" datetime,
  foreign key("admin_id") references "users"("id") on delete cascade,
  primary key("id")
);
CREATE INDEX "notifications_notifiable_type_notifiable_id_index" on "notifications"(
  "notifiable_type",
  "notifiable_id"
);

INSERT INTO migrations VALUES(1,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO migrations VALUES(4,'2025_09_24_032505_create_contacts_table',1);
INSERT INTO migrations VALUES(5,'2025_10_05_105658_create_devis_table',1);
INSERT INTO migrations VALUES(6,'2025_10_08_063030_create_prestations_table',1);
INSERT INTO migrations VALUES(7,'2025_10_13_122100_create_coordonnees_table',1);
INSERT INTO migrations VALUES(8,'2025_10_16_103258_create_admin_notifications_table',1);
INSERT INTO migrations VALUES(9,'2025_10_20_120000_create_objets_table',1);
INSERT INTO migrations VALUES(10,'2025_11_01_170454_create_devis_lignes_table',1);
INSERT INTO migrations VALUES(11,'2025_11_20_095441_create_messages_table',1);
INSERT INTO migrations VALUES(12,'2025_11_23_133652_add_reponse_to_contacts_table',1);
INSERT INTO migrations VALUES(13,'2025_11_24_162725_create_zones_table',1);
INSERT INTO migrations VALUES(14,'2025_11_24_210003_create_devis_prestations_table',1);
INSERT INTO migrations VALUES(15,'2025_11_30_115920_add_adresse_to_users_table',1);
INSERT INTO migrations VALUES(16,'2025_11_30_124405_create_rendezvous_table',1);
INSERT INTO migrations VALUES(17,'2025_12_02_133706_modify_telephone_column_in_coordonnees_table',1);
INSERT INTO migrations VALUES(18,'2025_12_02_153118_create_notifications_table',1);
