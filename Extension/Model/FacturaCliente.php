<?php
/**
 * This file is part of PrintChecker plugin for FacturaScripts
 * Copyright (C) 2022-2025 Tono Mollá González <hola@tonomolla.es>.
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

namespace FacturaScripts\Plugins\PrintChecker\Extension\Model;

/**
 * Description of ListFacturaCliente.
 *
 * @author Tono Mollá González <hola@tonomolla.es>
 */
class FacturaCliente
{
    protected function saveInsert()
    {
        return function (array $values = []): bool {
            $this->printed = false;

            return $this->save();
        };
    }
}