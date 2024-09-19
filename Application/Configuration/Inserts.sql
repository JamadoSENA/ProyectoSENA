
INSERT INTO roles VALUES (1, "Paciente");
INSERT INTO roles VALUES (2, "Doctor");
INSERT INTO roles VALUES (3, "Inventarista");
INSERT INTO roles VALUES (4, "Adminitrador");

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
    300, 
    'Disponible', 
    '2025-04-15', 
    'Analgésico', 
    900123456
);

CALL INSERTARMEDICINA(
    'Ibuprofeno', 
    'Cápsulas', 
    300, 
    'Disponible', 
    '2024-10-28', 
    'Anti-inflamatorio', 
    900654321
);

CALL INSERTARMEDICINA(
    'Amoxicilina', 
    'Suspensión', 
    300, 
    'Bueno', 
    '2025-11-22', 
    'Antibiótico', 
    900987654
);

CALL INSERTARMEDICINA(
    'Cetirizina', 
    'Tabletas', 
    300, 
    'Disponible', 
    '2026-01-20', 
    'Antihistamínico', 
    900321654
);

CALL INSERTARMEDICINA(
    'Omeprazol', 
    'Tabletas', 
    300, 
    'Disponible', 
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
    'admin@gmail.com', 
    '12345admin', 
    4
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
    'doctor@gmail.com', 
    '12345doctor', 
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
    'paciente@gmail.com', 
    '12345paciente', 
    1
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
    'inventarista@gmail.com', 
    '12345inventarista', 
    3
);


CALL INSERTARCITA(
    'Reservada', 
    '2024-09-16 09:00:00', 
    112233445, 
    987654321
);

CALL INSERTARCITA(
    'Reservada', 
    '2024-09-17 14:00:00', 
    112233445, 
    987654321
);

CALL INSERTARCITA(
    'Reservada', 
    '2024-09-18 11:00:00', 
    112233445, 
    987654321
);

CALL INSERTARCITA(
    'Reservada', 
    '2024-09-19 19:00:00', 
    112233445,
	987654321
    
);

CALL INSERTARCITA(
    'Reservada', 
    '2024-09-20 17:00:00', 
    112233445, 
    987654321
);

CALL INSERTARCITA(
    'Reservada', 
    '2024-09-20 20:00:00', 
    112233445, 
    987654321
);

CALL INSERTARCITA(
    'Reservada', 
    '2024-09-21 17:00:00', 
    112233445, 
    987654321
);

CALL INSERTARDIAGNOSTICO(
    'Dolor en el pecho', 
    'Fiebre alta, tos persistente', 
    'Sin antecedentes importantes', 
    'Madre con hipertensión', 
    'Presión arterial alta', 
    'Examen físico completo', 
    'Se recomienda reposo', 
    1
);

CALL INSERTARDIAGNOSTICO(
    'Dolor de cabeza', 
    'Náuseas, mareos', 
    'Migrañas frecuentes', 
    'Padre con diabetes', 
    'Normal', 
    'Evaluación neurológica', 
    'Consultar con un neurólogo', 
    2
);

CALL INSERTARDIAGNOSTICO(
    'Problemas respiratorios', 
    'Dificultad para respirar', 
    'Alergias estacionales', 
    'Abuelos con asma', 
    'Ruidos respiratorios', 
    'Radiografía de tórax', 
    'Evitar alérgenos', 
    3
);

CALL INSERTARDIAGNOSTICO(
    'Cansancio extremo', 
    'Fatiga crónica, pérdida de peso', 
    'Historial de anemia', 
    'Sin antecedentes familiares relevantes', 
    'Anemia leve', 
    'Examen hematológico', 
    'Consultar con un hematólogo', 
    4
);

CALL INSERTARDIAGNOSTICO(
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
    '2 meses', 
    'Cada 8 horas', 
    30, 
    'No Retirado', 
    'Tomar con suficiente agua y no exceder la dosis recomendada.', 
    1, 
    1
);

CALL INSERTARRECETA(
    'Intramuscular', 
    '5 días',
    '1 mes', 
    'Cada 12 horas', 
    14, 
    'No Retirado', 
    'Aplicar lentamente para evitar irritación.', 
    2, 
    2
);

CALL INSERTARRECETA(
    'Oral, en ayunas', 
    '10 días', 
    '3 meses', 
    'Cada 24 horas', 
    20, 
    'No Retirado', 
    'No tomar con jugos cítricos.', 
    3, 
    3
);

CALL INSERTARRECETA(
    'Intravenosa', 
    '3 días', 
    '3 meses', 
    'Cada 24 horas', 
    10, 
    'No Retirado', 
    'Supervisar la reacción del paciente durante la administración.', 
    4, 
    4
);

CALL INSERTARRECETA(
    'Oral, con el desayuno', 
    '7 días', 
    '1 mes', 
    'Cada 8 horas', 
    18, 
    'No Retirado', 
    'Seguir las instrucciones de la etiqueta del medicamento.', 
    5, 
    5
);
