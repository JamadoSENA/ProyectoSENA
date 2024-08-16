DELIMITER //

CREATE PROCEDURE INSERTARUSUARIO (
    IN numeroDocumento int (11),
    IN tipoDocumento VARCHAR (20),
    IN nombre VARCHAR (50),
    IN apellido VARCHAR (50),
    IN fechaNacimiento VARCHAR (10),
    IN edad INT,
    IN genero VARCHAR (10),
    IN numeroTelefono VARCHAR (20),
    IN profesion VARCHAR (50),
    IN direccion VARCHAR (100),
    IN correo VARCHAR (100),
    IN contraseña VARCHAR (100),
    IN rol INT (11))

BEGIN

    INSERT INTO users (idUser, documentType, nameU, lastname, birthdate, age,
    gender, phoneNumber, profession, addressU, email, passwordU, fkIdRole)
    VALUES (numeroDocumento, tipoDocumento, nombre, apellido, fechaNacimiento,
    edad, genero, numeroTelefono, profesion, direccion, correo, contraseña, rol);
    
    COMMIT;

END//

CREATE PROCEDURE INSERTARCITA (
    IN estado VARCHAR (50),
    IN fechaInicio DATETIME,
    IN fechaFin DATETIME,
    IN paciente INT (11),
    IN doctor INT (11))

BEGIN

    INSERT INTO schedulings (stateS, dateHourStart, dateHourEnd, 
    fkIdPatient, fkIdDoctor)
    VALUES (estado, fechaInicio, fechaFin, paciente, doctor);
    
    COMMIT;

END//

CREATE PROCEDURE INSERTARDIASNOSTICO (
    IN razon VARCHAR (2000),
    IN sintomas VARCHAR (2000),
    IN historialPersonal VARCHAR (2000),
    IN historialFamiliar VARCHAR (2000),
    IN signos VARCHAR (2000),
    IN examinacion VARCHAR (2000),
    IN observaciones VARCHAR (2000),
    IN agendamientoId INT (11))

BEGIN

    INSERT INTO diagnoses (mainReason, mainSymptoms, personalHistory, familiarHistory,
    vitalSigns, physicalExamination, aditionalObservations, fkIdScheduling)
    VALUES (razon, sintomas, historialPersonal, historialFamiliar, signos,
    examinacion, observaciones, agendamientoId);
    
    COMMIT;

END//

CREATE PROCEDURE INSERTARPROVEEDOR (
    IN nit INT (11),
    IN nombre VARCHAR (100),
    IN direccion VARCHAR (100),
    IN correo VARCHAR (100),
    IN numeroTelefono VARCHAR (20))

BEGIN

    INSERT INTO suppliers (idSupplier, nameSU, addressSU, email, phoneNumber)
    VALUES (nit, nombre, direccion, correo, numeroTelefono);
    
    COMMIT;

END//

CREATE PROCEDURE INSERTARMEDICINA (
    IN nombre VARCHAR(100),
    IN formato VARCHAR(50),
    IN cantidad INT,
    IN estado VARCHAR(20),
    IN fechaExp VARCHAR(10),
    IN categoria VARCHAR(20),
    IN proveedorNit INT)
BEGIN

    INSERT INTO medicines (nameM, formatM, stock, stateM, expirationDate, category, fkIdSupplier)
    VALUES (nombre, formato, cantidad, estado, fechaExp, categoria, proveedorNit);

END//

CREATE PROCEDURE INSERTARRECETA (
    IN viaAdministracion VARCHAR(500),
    IN duracion VARCHAR(50),
    IN frecuencia VARCHAR (50),
    IN cantidad INT(11),
    IN estado VARCHAR(50),
    IN instrucciones VARCHAR(5000),
    IN medicina INT,
    IN diagnostico INT)
BEGIN

    INSERT INTO recipes (routeAdministration, duration, frequency, stateR, specialInstructions, 
    fkIdMedicine, fkIdDiagnosis)
    VALUES (viaAdministracion, duracion, frecuencia, cantidad, estado, instrucciones, medicina,
    diagnostico);

COMMIT;

END//

DELIMITER ;