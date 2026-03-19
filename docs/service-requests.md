# Service Requests & Scheduling (svc_*)

## Table Explanations (short)
- `svc_customer_requests`: Parent for all request flows. Holds pricing, notes, snapshots, and mode/status.
- `svc_customer_request_answers`: Snapshot of submitted answers. No dependency on the question system.
- `svc_free_estimations`: Extra metadata for free estimation requests.
- `svc_inspections`: Extra metadata for inspection requests.
- `svc_inspection_photos`: Photos attached to an inspection.
- `svc_subscriptions`: Extra metadata for subscription requests.
- `svc_appointments`: Shared scheduling table used by scheduled services and subscriptions (optional for inspections).

## Example Flows

### Free Estimation → Schedule Service
1. Create `svc_customer_requests` with `request_mode=free_estimation`.
2. Store snapshot rows in `svc_customer_request_answers`.
3. Create `svc_free_estimations` for the request.
4. When converted, create a new `svc_customer_requests` with `request_mode=schedule_service`.
5. Create `svc_appointments` for the scheduled service.

### Inspection with Photos
1. Create `svc_customer_requests` with `request_mode=inspection`.
2. Create `svc_inspections`.
3. Upload photos into `svc_inspection_photos` linked to the inspection.

### Subscription with Recurring Appointments
1. Create `svc_customer_requests` with `request_mode=subscription`.
2. Create `svc_subscriptions` with frequency and start date.
3. Generate `svc_appointments` per recurrence (if `auto_generate_appointments=true`).
