<?php
    require_once __DIR__ . '/db.php';

    /**
     * formats_all()
     * Returns all formats as an array of [id, name], ordered by name.
     */
    function formats_all(): array {
        $pdo = get_pdo();
        $stmt = $pdo->query("SELECT id, name FROM formats ORDER BY name");
        return $stmt->fetchAll();
    }

    /**
     * records_all()
     * Returns all records joined with formats.
     * Fields: title, artist, price, format_name
     */
    function records_all(): array {
        $pdo = get_pdo();
        $sql = "
            SELECT 
                records.title, 
                records.artist, 
                records.price, 
                formats.name AS format_name
            FROM records
            JOIN formats ON records.format_id = formats.id
            ORDER BY records.id DESC
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * record_insert()
     * Inserts a single record into the database.
     */
    function record_insert(): void {
        $pdo = get_pdo();

        // Temporary hardcoded test data
        $title = "Demo Title";
        $artist = "Demo Artist";
        $price = 9.99;
        $format_id = 1; // Assuming 1 = 'cd' or an existing format

        $sql = "INSERT INTO records (title, artist, price, format_id)
                VALUES (:title, :artist, :price, :format_id)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':title' => $title,
            ':artist' => $artist,
            ':price' => $price,
            ':format_id' => $format_id
        ]);

        $rows = $stmt->rowCount();
        echo "Insert success: " . ($rows === 1 ? 'true' : 'false') . ", rows: {$rows}<br>";

        // Confirm the insert
        $records = records_all();
        if (!empty($records)) {
            echo "Newest: " . $records[0]['title'] . " — " . $records[0]['format_name'] . "<br>";
        }
    }
?>