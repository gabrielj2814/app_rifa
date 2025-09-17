📋 Tablas necesarias para la app de rifas

### 1. **usuarios**

- `id`
- `nombre`
- `email` (único)
- `password` (si manejas login)
- `telefono`
- `rol` (admin, participante)
- `created_at`, `updated_at`

👉 Relación: un usuario puede comprar varios boletos.

---

### 2. **rifas**

- `id`
- `titulo`
- `descripcion`
- `precio_boleto`
- `fecha_inicio`
- `fecha_fin`
- `fecha_sorteo`
- `estado` (activa, cerrada, sorteada)
- `created_at`, `updated_at`

👉 Relación: una rifa tiene muchos boletos.

---

### 3. **boletos**

- `id`
- `rifa_id` (FK → rifas)
- `numero` (ej. 001, 002…)
- `usuario_id` (FK → usuarios, nullable si no se ha vendido)
- `estado` (disponible, reservado, vendido, pagado)
- `created_at`, `updated_at`

👉 Relación: un boleto pertenece a una rifa y puede ser comprado por un usuario.

---

### 4. **pagos**

- `id`
- `usuario_id` (FK → usuarios)
- `rifa_id` (FK → rifas)
- `boleto_id` (FK → boletos)
- `monto`
- `metodo_pago` (tarjeta, transferencia, efectivo, etc.)
- `estado` (pendiente, confirmado, rechazado)
- `fecha_pago`
- `created_at`, `updated_at`

👉 Relación: un pago corresponde a un boleto comprado.

---

### 5. **ganadores**

- `id`
- `rifa_id` (FK → rifas)
- `boleto_id` (FK → boletos)
- `usuario_id` (FK → usuarios)
- `premio` (ej. “Moto”, “$500”)
- `fecha_registro`
- `created_at`, `updated_at`

👉 Relación: una rifa puede tener uno o varios ganadores.

---

### 6. (Opcional) **premios**

- `id`
- `rifa_id` (FK → rifas)
- `descripcion`
- `valor_estimado`
- `posicion` (ej. 1er lugar, 2do lugar)
- `created_at`, `updated_at`

👉 Si quieres manejar varios premios por rifa antes del sorteo.

---

### 🔗 Resumen de relaciones

- **usuarios** 1️⃣---∞ **boletos**
- **rifas** 1️⃣---∞ **boletos**
- **boletos** 1️⃣---1️⃣ **pagos**
- **rifas** 1️⃣---∞ **ganadores**
- **rifas** 1️⃣---∞ **premios** (opcional)
