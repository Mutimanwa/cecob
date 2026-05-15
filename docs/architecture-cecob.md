# CECOB Platform Architecture

## 1. Vision produit
La plateforme CECOB est organisee en deux surfaces:

- `Public Website`: vitrine institutionnelle, actualites, evenements, galerie, contact, adhesion.
- `Administration Panel`: membres, validation, finances, contenu, documents, notifications, partenaires, parametres.

## 2. Modules fonctionnels

- `Public`: accueil, association, leadership, actualites, evenements, galerie, contact, adhesion.
- `Admin`: dashboard, roles/utilisateurs, membres, validation d’adhesion, cartes membres, paiements/cotisations, CMS, notifications, documents, partenaires, settings.

## 3. Workflow membre

1. Le candidat remplit le formulaire d’adhesion.
2. Le secretariat verifie les pieces.
3. L’admin accepte, rejette ou demande correction.
4. Si accepte: creation `user`, `member`, `member_card`, QR code et notification.
5. Le membre accede a son espace, ses paiements et ses evenements.

## 4. Base de donnees relationnelle

### Tables coeur

- `users`: identite, email, password_hash, role_id, status, last_login_at
- `roles`: nom, slug
- `permissions`: nom, slug
- `role_permissions`: role_id, permission_id
- `members`: user_id, member_number, personal_data, academic_data, status
- `member_cards`: member_id, qr_code_path, expires_at, revoked_at
- `adhesion_requests`: applicant_data, document_paths, review_status, reviewer_id, review_note
- `posts`: category_id, title, slug, body, featured_image, seo_meta, status, published_at
- `post_categories`: name, slug
- `events`: title, description, starts_at, ends_at, location, organizer_id, capacity, registration_deadline
- `event_registrations`: event_id, member_id, attendance_status
- `galleries`: event_id, title, visibility
- `media_files`: gallery_id, type, path, alt_text
- `payments`: member_id, cotisation_id, amount, method, paid_at, status, receipt_number
- `cotisations`: title, period_type, due_date, amount
- `notifications`: user_id, channel, title, body, is_read, scheduled_at, sent_at
- `documents`: category, title, file_path, visibility, download_count
- `partners`: name, logo_path, website_url, sponsorship_notes, status
- `settings`: key, value
- `contact_messages`: name, email, phone, subject, message, status
- `activity_logs`: actor_id, action, entity_type, entity_id, meta_json, created_at

## 5. API structure

### Auth

- `POST /api/auth/login`
- `POST /api/auth/logout`
- `POST /api/auth/forgot-password`
- `POST /api/auth/reset-password`

### Public

- `GET /api/posts`
- `GET /api/events`
- `GET /api/partners`
- `POST /api/contact`
- `POST /api/adhesion-requests`

### Admin

- `GET /api/admin/dashboard`
- `GET /api/admin/members`
- `PATCH /api/admin/members/{id}/status`
- `GET /api/admin/adhesion-requests`
- `POST /api/admin/adhesion-requests/{id}/approve`
- `POST /api/admin/adhesion-requests/{id}/reject`
- `POST /api/admin/adhesion-requests/{id}/request-correction`
- `CRUD /api/admin/events`
- `CRUD /api/admin/posts`
- `CRUD /api/admin/documents`
- `CRUD /api/admin/partners`
- `CRUD /api/admin/cotisations`
- `GET /api/admin/payments/reports`

## 6. Permissions

- `super_admin`: acces total
- `president`: supervision, lecture globale, publications majeures
- `secretary`: adhesion, membres, documents
- `treasurer`: cotisations, paiements, recus, rapports
- `communication_manager`: posts, notifications, partenaires, galerie
- `moderator`: moderation contenus et messages

## 7. Backend cible

- `Presentation`: controllers HTTP, validation, transformers
- `Application`: services d’adhesion, paiements, notifications, CMS
- `Domain`: entites, policies, workflows
- `Infrastructure`: ORM, storage fichiers, email, QR, audit logs

## 7.bis. Variante retenue dans ce depot

Le backend demandé est realise en `PHP pur procédural`:

- `config/`: configuration application et PDO
- `includes/`: bootstrap, helpers, auth, layouts partages
- `public_handlers/`: traitements POST publics
- `admin/`: ecrans admin et endpoints de session
- `database/cecob.sql`: schema et seed de depart

Les acces base utilisent `PDO`, les formulaires sont proteges par token CSRF de session, et l’auth admin passe par `password_hash` / `password_verify`.

## 8. Folder structure recommandee

```text
cecob/
  public/
  admin/
  assets/
  docs/
  backend/
    app/
      Http/
      Services/
      Models/
      Policies/
      Notifications/
    database/
      migrations/
      seeders/
    routes/
      api.php
      web.php
```

## 9. Securite

- JWT ou session securisee selon stack finale
- hash de mot de passe avec Argon2id ou bcrypt
- RBAC par permission
- CSRF protection
- rate limiting sur login, contact et adhesion
- validation MIME, taille et antivirus sur uploads
- audit logs sur actions sensibles
- URLs signees pour documents prives

## 10. SaaS-readiness

- modules decouples
- settings centralises
- services de notification abstraits
- stockage media externalisable
- reporting extensible
- workflows validables par etape
