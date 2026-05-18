ACT AS:
A senior SaaS Architect, Enterprise System Analyst, and Full Stack Product Designer specialized in building large-scale association management platforms, membership systems, administrative dashboards, and institutional portals using modern web technologies.

OBJECTIVE:
Design a complete, professional, scalable, and production-ready Association Management Platform for “CECOB” (Association des Étudiants Congolais au Burundi).

The system must include:
- Public Website
- Member Management System
- Online Membership Registration
- Administrative Dashboard
- Content Management
- Event Management
- Financial/Cotisation Management
- Notification System
- Role & Permission Management
- Institutional Data Management

The platform must be designed like a modern professional SaaS application with a clean architecture, secure workflows, scalable modules, and enterprise-level UX.

====================================================
GLOBAL SYSTEM STRUCTURE
====================================================

The platform contains 2 major parts:

1. PUBLIC WEBSITE
Accessible by visitors and members.

2. ADMINISTRATION PANEL
Accessible only by authenticated users according to their permissions.

====================================================
PUBLIC WEBSITE MODULES
====================================================

----------------------------------------------------
1. HOME PAGE
----------------------------------------------------

Purpose:
Present the association professionally.

Sections:
- Hero section
- Presentation of CECOB
- Mission and vision
- Statistics
- Upcoming events
- Latest news/blog posts
- Leadership preview
- Partner logos
- CTA buttons:
  - Become a member
  - Contact us
  - Explore events

Functionalities:
- Dynamic content from admin panel
- Responsive animations
- SEO optimization
- Dynamic statistics

====================================================

----------------------------------------------------
2. ABOUT PAGE
----------------------------------------------------

Purpose:
Explain the association identity.

Sections:
- History
- Vision
- Mission
- Objectives
- Values
- Internal organization
- Institutional documents
- Leadership structure

Admin can:
- Edit content
- Upload documents
- Manage sections dynamically

====================================================

----------------------------------------------------
3. TEAM / LEADERSHIP PAGE
----------------------------------------------------

Purpose:
Display all official leaders and committees.

Display:
- Photo
- Name
- Position
- Biography
- Social links
- Mandate duration

Categories:
- Executive committee
- Department heads
- Event teams
- Communication team

Admin functionalities:
- Add/edit/remove members
- Change order
- Activate/deactivate profiles

====================================================

----------------------------------------------------
4. BLOG / NEWS MODULE
----------------------------------------------------

Purpose:
Publish articles and announcements.

Features:
- Article categories
- Tags
- Featured articles
- Rich text editor
- Article image
- SEO metadata
- Draft/published status
- Scheduled publishing

Public functionalities:
- Read article
- Search
- Filter by category
- Share article
- Related posts

Admin functionalities:
- Create/edit/delete posts
- Manage categories
- Moderate comments

====================================================

----------------------------------------------------
5. EVENTS MODULE
----------------------------------------------------

Purpose:
Manage association events.

Public functionalities:
- Event listing
- Event details
- Registration form
- Calendar view
- Event countdown
- Gallery after event

Admin functionalities:
- Create event
- Manage participants
- Attendance tracking
- Upload event media
- Generate reports

Event data:
- Title
- Description
- Date
- Location
- Organizer
- Capacity
- Registration deadline

====================================================

----------------------------------------------------
6. GALLERY MODULE
----------------------------------------------------

Purpose:
Display association activities visually.

Features:
- Albums
- Photos
- Videos
- Event galleries

Admin functionalities:
- Upload media
- Organize albums
- Set visibility

====================================================

----------------------------------------------------
7. CONTACT PAGE
----------------------------------------------------

Features:
- Contact form
- Phone numbers
- Email addresses
- Social media links
- Office location
- Google map integration

Admin functionalities:
- Receive messages
- Reply management
- Spam protection

====================================================

----------------------------------------------------
8. ONLINE MEMBERSHIP / ADHESION MODULE
----------------------------------------------------

Purpose:
Allow students to join CECOB online.

Workflow:

STEP 1 — APPLICATION FORM
The applicant fills:
- Full name
- Gender
- Birth date
- Nationality
- University
- Faculty
- Department
- Academic level
- Email
- Phone
- Password
- Student ID
- Profile photo
- Supporting documents

STEP 2 — APPLICATION REVIEW
Admin reviews:
- Accept
- Reject
- Request correction

STEP 3 — MEMBER CREATION
If approved:
- Generate member number
- Generate digital member card
- Generate QR code
- Create member account

STEP 4 — MEMBER ACCESS
Member can:
- Update profile
- Download member card
- View events
- Pay contributions
- Receive announcements

====================================================
ADMINISTRATION PANEL
====================================================

----------------------------------------------------
1. ADMIN DASHBOARD
----------------------------------------------------

Purpose:
Provide system overview.

Widgets:
- Total members
- Pending memberships
- Active events
- Blog statistics
- Payments
- Notifications
- Recent activities

Features:
- Real-time statistics
- Charts
- Quick actions
- Activity logs

====================================================

----------------------------------------------------
2. USER & ROLE MANAGEMENT
----------------------------------------------------

Purpose:
Control system access.

Roles:
- Super Admin
- President
- Secretary
- Treasurer
- Communication Manager
- Moderator

Features:
- Role permissions
- Account activation
- Password reset
- Login history
- Session management

Permissions examples:
- Manage members
- Publish posts
- Validate adhesion
- Manage payments

====================================================

----------------------------------------------------
3. MEMBER MANAGEMENT MODULE
----------------------------------------------------

Purpose:
Manage all association members.

Features:
- Member list
- Advanced search
- Filters
- Export PDF/Excel
- Status management

Statuses:
- Active
- Pending
- Suspended
- Former member

Member profile:
- Personal information
- Academic information
- Membership history
- Payments
- Attendance

====================================================

----------------------------------------------------
4. MEMBERSHIP VALIDATION MODULE
----------------------------------------------------

Purpose:
Manage adhesion requests.

Features:
- Pending applications
- Validation workflow
- Rejection reasons
- Correction requests
- Automatic notifications

====================================================

----------------------------------------------------
5. DIGITAL MEMBER CARD MODULE
----------------------------------------------------

Purpose:
Generate member identity cards.

Features:
- QR code
- Expiration date
- Download PDF
- Card verification

Admin can:
- Revoke card
- Regenerate card
- Print cards

====================================================

----------------------------------------------------
6. PAYMENT & COTISATION MODULE
----------------------------------------------------

Purpose:
Manage financial contributions.

Features:
- Payment records
- Contribution plans
- Receipts
- Payment status
- Monthly reports

Statuses:
- Paid
- Pending
- Overdue

Payment methods:
- Mobile money
- Bank transfer
- Cash

Reports:
- Total collected
- Monthly income
- Outstanding balances

====================================================

----------------------------------------------------
7. CONTENT MANAGEMENT MODULE
----------------------------------------------------

Purpose:
Manage all public website content.

Features:
- Dynamic pages
- Homepage sections
- Media uploads
- SEO settings

====================================================

----------------------------------------------------
8. NOTIFICATION SYSTEM
----------------------------------------------------

Purpose:
Communicate with members.

Notification types:
- Email
- Dashboard notifications
- Membership updates
- Event reminders

Features:
- Broadcast messages
- Scheduled notifications
- Read/unread status

====================================================

----------------------------------------------------
9. DOCUMENT MANAGEMENT MODULE
----------------------------------------------------

Purpose:
Manage institutional documents.

Features:
- Upload PDFs
- Download tracking
- Visibility control
- Categories

Documents:
- Constitution
- Internal rules
- Reports
- Official announcements

====================================================

----------------------------------------------------
10. PARTNER MANAGEMENT MODULE
----------------------------------------------------

Purpose:
Manage institutional partners.

Features:
- Partner logos
- Descriptions
- Websites
- Sponsorship information

====================================================

----------------------------------------------------
11. SETTINGS MODULE
----------------------------------------------------

Purpose:
Manage system configuration.

Settings:
- Association information
- Logo
- Colors
- Email SMTP
- Social links
- Security settings
- SEO settings

====================================================
SYSTEM SECURITY
====================================================

Implement:
- JWT Authentication
- Role-based access control
- Password hashing
- Rate limiting
- CSRF protection
- Audit logs
- File validation
- Secure uploads

====================================================
DATABASE REQUIREMENTS
====================================================

Design a scalable relational database with:

TABLES:
- users
- roles
- permissions
- members
- member_cards
- adhesion_requests
- posts
- post_categories
- events
- event_registrations
- galleries
- media_files
- payments
- cotisations
- notifications
- documents
- partners
- settings
- contact_messages
- activity_logs

Relationships must be properly normalized.


====================================================
UI/UX REQUIREMENTS
====================================================

Design style:
- Modern institutional design
- Professional dashboard
- Mobile responsive
- Clean typography
- Accessible UI
- Fast loading

Admin UI must include:
- Sidebar navigation
- Data tables
- Filters
- Modals
- Charts
- Statistics cards

====================================================
EXPECTED OUTPUT
====================================================

Generate:
1. Complete system architecture
2. Full module breakdown
3. User workflows
4. Database schema structure
5. Dashboard structure
6. API structure
7. Folder structure
8. Permission system
9. Frontend page structure
10. Backend architecture
11. Responsive UX logic
12. Security strategy
13. Scalable SaaS-ready architecture
14. Professional admin experience
15. Detailed workflow for every module