# 🚛 TruckerView Dashboard API Routes

## 📋 Auth Endpoints

### 1️⃣ **Register** (Qeydiyyat)
```http
POST /api/register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "user" // optional: "user" və ya "admin"
}
```

**Response:**
```json
{
  "message": "User registered successfully",
  "user": {...},
  "token": "1|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
}
```

---

### 2️⃣ **Login** (Giriş)
```http
POST /api/login
Content-Type: application/json

{
  "email": "john@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "message": "Login successful",
  "user": {...},
  "token": "2|xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
}
```

---

### 3️⃣ **Logout** (Çıxış)
```http
POST /api/logout
Authorization: Bearer {token}
```

**Response:**
```json
{
  "message": "Logged out successfully"
}
```

---

### 4️⃣ **Get Current User** (İstifadəçi məlumatı)
```http
GET /api/user
Authorization: Bearer {token}
```

**Response:**
```json
{
  "id": 1,
  "name": "John Doe",
  "email": "john@example.com",
  "role": "user",
  ...
}
```

---

### 5️⃣ **Forgot Password** (Şifrəni unutdum)
```http
POST /api/password/email
Content-Type: application/json

{
  "email": "john@example.com"
}
```

**Response:**
```json
{
  "message": "Password reset link sent to your email"
}
```

---

### 6️⃣ **Reset Password** (Şifrəni dəyiş)
```http
POST /api/password/reset
Content-Type: application/json

{
  "token": "reset-token-from-email",
  "email": "john@example.com",
  "password": "newpassword123",
  "password_confirmation": "newpassword123"
}
```

**Response:**
```json
{
  "message": "Password reset successfully"
}
```

---

## 🌐 Web Routes (Inertia + React)

Bu route-lar brauzer üçündür və Laravel Fortify ilə idarə olunur:

- `GET /` - Ana səhifə (Welcome)
- `GET /login` - Login səhifəsi
- `GET /register` - Qeydiyyat səhifəsi
- `GET /forgot-password` - Şifrəni unutdum
- `GET /reset-password/{token}` - Şifrəni yenilə
- `GET /email/verify` - Email təsdiqləmə
- `GET /two-factor-challenge` - 2FA challenge
- `GET /dashboard` - Dashboard (auth required)
- `GET /settings/profile` - Profil parametrləri
- `GET /settings/password` - Şifrə parametrləri
- `GET /settings/appearance` - Görünüş parametrləri
- `GET /settings/two-factor` - 2FA parametrləri

---

## 🔐 Authentication

API endpoint-lərinə giriş üçün **Bearer Token** istifadə edin:

```
Authorization: Bearer {your-token-here}
```

Token-i `/api/login` və ya `/api/register` endpoint-lərindən əldə edə bilərsiniz.

---

## 📦 TypeScript Routes

Laravel Wayfinder avtomatik olaraq TypeScript route funksiyaları yaradır:

```typescript
import { route } from '@/routes'

// Web routes
route('home')
route('dashboard')
route('profile.edit')

// API routes - frontend-dən istifadə üçün deyil, sadəcə referans
```

---

## 🛠️ Test Commands

```bash
# Bütün route-ları göstər
php artisan route:list

# Yalnız API route-ları
php artisan route:list --path=api

# TypeScript route-ları yenilə
php artisan wayfinder:generate
```
