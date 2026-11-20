#!/bin/bash
# Backup database MySQL Jejak-Bali: dump + gzip, simpan 14 hari terakhir.
set -euo pipefail

DB_NAME="jejak_bali"
DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="${DB_PORT:-3306}"
DB_USER="${DB_USER:-root}"
OUT_DIR="$(dirname "$0")/../backups"
mkdir -p "$OUT_DIR"
TS=$(date +%Y%m%d_%H%M%S)
OUT_FILE="$OUT_DIR/jejak_bali_$TS.sql.gz"

mysqldump -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USER" "$DB_NAME" | gzip > "$OUT_FILE"
echo "[backup] tersimpan: $OUT_FILE ($(du -h "$OUT_FILE" | cut -f1))"

find "$OUT_DIR" -name "jejak_bali_*.sql.gz" -mtime +14 -delete
echo "[backup] retensi 14 hari: $(ls "$OUT_DIR"/jejak_bali_*.sql.gz 2>/dev/null | wc -l) file tersisa"
