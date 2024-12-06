<?php
/**
 * This file is part of PrintChecker plugin for FacturaScripts
 * Copyright (C) 2022-2025 Tono Mollá González <hola@tonomolla.es>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace FacturaScripts\Plugins\PrintChecker\Extension\Controller;

use FacturaScripts\Core\Model\PresupuestoCliente;

class ListPresupuestoCliente
{
    protected function execPreviousAction()
    {
        return function ($action) {
            $opcion = isset($_GET["option"]) ? $_GET["option"] : (isset($_POST["option"]) ? $_POST["option"] : null);

            if ($action === 'export' && $opcion == 'PDF') {
                foreach($_POST['code'] as $id) {
                    $presupuesto = new PresupuestoCliente();
                    $presupuesto->loadFromCode($id);
                    $presupuesto->printed = true;
                    $presupuesto->save();
                }
            }
        };
    }
} 