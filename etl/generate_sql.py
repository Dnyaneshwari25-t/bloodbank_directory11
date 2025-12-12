import csv

def generate_sql(csv_file, output_file):
    with open(csv_file, 'r', encoding='utf-8') as f, open(output_file, 'w', encoding='utf-8') as out:
        reader = csv.DictReader(f)
        counter = 1
        for row in reader:
            public_id = f"INST{counter:04d}"

            name = row['name'].replace("'", "''")
            type_ = row.get('type', 'charitable')
            location = row['address'].replace("'", "''")
            contact = row.get('contact', '')

            sql = (
                "INSERT IGNORE INTO institutes (public_id, name, type, location, has_blood_bank, contact, status) "
                f"VALUES ('{public_id}', '{name}', '{type_}', '{location}', 1, '{contact}', 'active');\n"
            )

            out.write(sql)
            counter += 1

generate_sql('bloodbanks_clean.csv', 'inserts.sql')

