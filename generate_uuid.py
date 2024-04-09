import uuid

# Générer 7 UUID et les stocker dans une liste
uuid_list = [str(uuid.uuid4()) for _ in range(29)]

# Afficher les UUID générés
for uuid_val in uuid_list:
    print(uuid_val)
