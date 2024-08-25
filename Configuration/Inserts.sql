insert into roles values (1, "Paciente");

insert into roles values (2, "Doctor");

insert into roles values (3, "Inventarista");

CALL INSERTARPROVEEDOR(
    900123456, 
    'Farmacéutica ABC', 
    'Calle 45 #67-89', 
    'contacto@farmabc.com', 
    '3001234567'
);

CALL INSERTARPROVEEDOR(
    900654321, 
    'Medicamentos XYZ', 
    'Avenida 12 #34-56', 
    'info@medicxyz.com', 
    '3007654321'
);

CALL INSERTARPROVEEDOR(
    900987654, 
    'Salud Plus', 
    'Calle 78 #90-12', 
    'ventas@saludplus.com', 
    '3001112233'
);

CALL INSERTARPROVEEDOR(
    900321654, 
    'Laboratorios Med', 
    'Carrera 56 #78-90', 
    'contacto@labmed.com', 
    '3004455667'
);

CALL INSERTARPROVEEDOR(
    900456789, 
    'Medicinales SA', 
    'Calle 22 #11-23', 
    'ventas@medicinales.com', 
    '3005566778'
);

CALL INSERTARMEDICINA(
    'Paracetamol', 
    'Tabletas', 
    100, 
    'Bueno', 
    '2025-12-31', 
    'Analgésico', 
    900123456
);

CALL INSERTARMEDICINA(
    'Ibuprofeno', 
    'Cápsulas', 
    200, 
    'Excelente', 
    '2026-03-15', 
    'Anti-inflamatorio', 
    900654321
);

CALL INSERTARMEDICINA(
    'Amoxicilina', 
    'Suspensión', 
    150, 
    'Bueno', 
    '2025-10-10', 
    'Antibiótico', 
    900987654
);

CALL INSERTARMEDICINA(
    'Cetirizina', 
    'Tabletas', 
    120, 
    'Excelente', 
    '2026-01-20', 
    'Antihistamínico', 
    900321654
);

CALL INSERTARMEDICINA(
    'Omeprazol', 
    'Tabletas', 
    80, 
    'Bueno', 
    '2025-08-15', 
    'Antiacido', 
    900456789
);

CALL INSERTARUSUARIO(
    123456789, 
    'Cédula de Ciudadanía', 
    'Juan', 
    'Pérez', 
    '1985-06-15', 
    39, 
    'Masculino', 
    '3001234567', 
    'Ingeniero', 
    'Calle 123 #45-67', 
    'juan.perez@example.com', 
    'juan2024!', 
    1
);

CALL INSERTARUSUARIO(
    987654321, 
    'Pasaporte', 
    'Ana', 
    'Gómez', 
    '1990-03-22', 
    34, 
    'Femenino', 
    '3007654321', 
    'Médico', 
    'Avenida 98 #76-54', 
    'ana.gomez@example.com', 
    'ana2024$', 
    2
);

CALL INSERTARUSUARIO(
    112233445, 
    'Cédula de Ciudadanía', 
    'Carlos', 
    'Martínez', 
    '1982-10-05', 
    41, 
    'Masculino', 
    '3001112233', 
    'Abogado', 
    'Carrera 60 #23-45', 
    'carlos.martinez@example.com', 
    'carlos2024#', 
    3
);

CALL INSERTARUSUARIO(
    55667788, 
    'Cédula de Ciudadanía', 
    'Laura', 
    'Ramírez', 
    '1995-12-30', 
    28, 
    'Femenino', 
    '3004455667', 
    'Arquitecta', 
    'Calle 44 #78-90', 
    'laura.ramirez@example.com', 
    'laura2024!', 
    1
);

CALL INSERTARUSUARIO(
    123098456, 
    'Tarjeta de Identidad', 
    'Pedro', 
    'García', 
    '1988-04-10', 
    36, 
    'Masculino', 
    '3009876543', 
    'Contador', 
    'Calle 80 #12-34', 
    'pedro.garcia@example.com', 
    'pedro2024@', 
    2
);

CALL INSERTARCITA(
    'Confirmada', 
    '2024-08-25 09:00:00', 
    '2024-08-25 10:00:00', 
    123456789, 
    987654321
);

CALL INSERTARCITA(
    'Pendiente', 
    '2024-08-26 14:00:00', 
    '2024-08-26 15:00:00', 
    112233445, 
    55667788
);

CALL INSERTARCITA(
    'Cancelada', 
    '2024-08-27 11:00:00', 
    '2024-08-27 12:00:00', 
    55667788, 
    123456789
);

CALL INSERTARCITA(
    'Confirmada', 
    '2024-08-28 16:00:00', 
    '2024-08-28 17:00:00', 
    987654321, 
    112233445
);

CALL INSERTARCITA(
    'Confirmada', 
    '2024-08-29 10:00:00', 
    '2024-08-29 11:00:00', 
    123456789, 
    55667788
);

CALL INSERTARDIASNOSTICO(
    'Dolor en el pecho', 
    'Fiebre alta, tos persistente', 
    'Sin antecedentes importantes', 
    'Madre con hipertensión', 
    'Presión arterial alta', 
    'Examen físico completo', 
    'Se recomienda reposo', 
    1
);

CALL INSERTARDIASNOSTICO(
    'Dolor de cabeza', 
    'Náuseas, mareos', 
    'Migrañas frecuentes', 
    'Padre con diabetes', 
    'Normal', 
    'Evaluación neurológica', 
    'Consultar con un neurólogo', 
    2
);

CALL INSERTARDIASNOSTICO(
    'Problemas respiratorios', 
    'Dificultad para respirar', 
    'Alergias estacionales', 
    'Abuelos con asma', 
    'Ruidos respiratorios', 
    'Radiografía de tórax', 
    'Evitar alérgenos', 
    3
);

CALL INSERTARDIASNOSTICO(
    'Cansancio extremo', 
    'Fatiga crónica, pérdida de peso', 
    'Historial de anemia', 
    'Sin antecedentes familiares relevantes', 
    'Anemia leve', 
    'Examen hematológico', 
    'Consultar con un hematólogo', 
    4
);

CALL INSERTARDIASNOSTICO(
    'Dolor abdominal', 
    'Dolor en el abdomen inferior', 
    'Historial de úlceras', 
    'Madre con gastritis', 
    'Dolor agudo', 
    'Endoscopia recomendada', 
    'Seguir tratamiento indicado', 
    5
);

CALL INSERTARRECETA(
    'Oral, después de las comidas', 
    '7 días', 
    'Cada 8 horas', 
    30, 
    'No tomar con alcohol', 
    'Tomar con suficiente agua y no exceder la dosis recomendada.', 
    1, 
    1
);

CALL INSERTARRECETA(
    'Intramuscular', 
    '5 días', 
    'Cada 12 horas', 
    14, 
    'Mantener en refrigeración', 
    'Aplicar lentamente para evitar irritación.', 
    2, 
    2
);

CALL INSERTARRECETA(
    'Oral, en ayunas', 
    '10 días', 
    'Cada 24 horas', 
    20, 
    'Tomar con agua', 
    'No tomar con jugos cítricos.', 
    3, 
    3
);

CALL INSERTARRECETA(
    'Intravenosa', 
    '3 días', 
    'Cada 24 horas', 
    10, 
    'Administrar lentamente', 
    'Supervisar la reacción del paciente durante la administración.', 
    4, 
    4
);

CALL INSERTARRECETA(
    'Oral, con el desayuno', 
    '7 días', 
    'Cada 8 horas', 
    18, 
    'No exceder la dosis recomendada', 
    'Seguir las instrucciones de la etiqueta del medicamento.', 
    5, 
    5
);
