<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Lang;

class TranslationHelper
{
    /**
     * Obtener el nombre de un campo para una entidad específica
     * 
     * @param string $entity - Nombre de la entidad (barber, specialty, etc.)
     * @param string $field - Nombre del campo
     * @return string
     */
    public static function getFieldLabel(string $entity, string $field): string
    {
        $key = "labels.fields.{$entity}.{$field}";
        $translation = trans($key);
        
        // Si no existe la traducción específica, intentar obtener del archivo de validación
        if ($translation === $key) {
            $validationKey = "validation.attributes.{$field}";
            $translation = trans($validationKey);
            
            // Si tampoco existe, retornar el campo formateado
            if ($translation === $validationKey) {
                return ucfirst(str_replace('_', ' ', $field));
            }
        }
        
        return $translation;
    }

    /**
     * Obtener el nombre singular de una entidad
     * 
     * @param string $entity
     * @return string
     */
    public static function getEntitySingular(string $entity): string
    {
        $key = "labels.entities.{$entity}.singular";
        $translation = trans($key);
        
        return $translation !== $key ? $translation : ucfirst($entity);
    }

    /**
     * Obtener el nombre plural de una entidad
     * 
     * @param string $entity
     * @return string
     */
    public static function getEntityPlural(string $entity): string
    {
        $key = "labels.entities.{$entity}.plural";
        $translation = trans($key);
        
        return $translation !== $key ? $translation : ucfirst($entity) . 's';
    }

    /**
     * Obtener un mensaje de éxito
     * 
     * @param string $action - Acción realizada (created, updated, deleted)
     * @param string $entity - Entidad afectada
     * @return string
     */
    public static function getSuccessMessage(string $action, string $entity): string
    {
        $entityName = self::getEntitySingular($entity);
        $key = "labels.messages.success.{$action}";
        
        return trans($key, ['entity' => $entityName]);
    }

    /**
     * Obtener un mensaje de error
     * 
     * @param string $action - Acción fallida
     * @param string $entity - Entidad afectada
     * @return string
     */
    public static function getErrorMessage(string $action, string $entity): string
    {
        $entityName = self::getEntitySingular($entity);
        $key = "labels.messages.error.{$action}";
        
        return trans($key, ['entity' => $entityName]);
    }

    /**
     * Obtener un mensaje de confirmación
     * 
     * @param string $action - Acción a confirmar
     * @param string $entity - Entidad afectada
     * @return string
     */
    public static function getConfirmMessage(string $action, string $entity): string
    {
        $entityName = self::getEntitySingular($entity);
        $key = "labels.messages.confirm.{$action}";
        
        return trans($key, ['entity' => $entityName]);
    }

    /**
     * Obtener una etiqueta de acción
     * 
     * @param string $action
     * @return string
     */
    public static function getActionLabel(string $action): string
    {
        $key = "labels.actions.{$action}";
        $translation = trans($key);
        
        return $translation !== $key ? $translation : ucfirst($action);
    }

    /**
     * Obtener una etiqueta de estado
     * 
     * @param string $status
     * @return string
     */
    public static function getStatusLabel(string $status): string
    {
        $key = "labels.status.{$status}";
        $translation = trans($key);
        
        return $translation !== $key ? $translation : ucfirst($status);
    }

    /**
     * Obtener el nombre de un día de la semana
     * 
     * @param string $day
     * @return string
     */
    public static function getDayLabel(string $day): string
    {
        $key = "labels.days.{$day}";
        $translation = trans($key);
        
        return $translation !== $key ? $translation : ucfirst($day);
    }

    /**
     * Generar un array de atributos para FormRequest
     * 
     * @param string $entity
     * @param array $fields
     * @return array
     */
    public static function getAttributesForEntity(string $entity, array $fields): array
    {
        $attributes = [];
        
        foreach ($fields as $field) {
            $attributes[$field] = self::getFieldLabel($entity, $field);
        }
        
        return $attributes;
    }

    /**
     * Generar mensajes de validación personalizados
     * 
     * @param string $entity
     * @param array $customMessages
     * @return array
     */
    public static function getCustomValidationMessages(string $entity, array $customMessages = []): array
    {
        $entityName = self::getEntitySingular($entity);
        $messages = [];
        
        // Mensajes predeterminados
        $defaultMessages = [
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El campo :attribute debe ser un correo electrónico válido.',
            'unique' => 'Este :attribute ya está registrado.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'confirmed' => 'La confirmación de :attribute no coincide.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'image' => 'El campo :attribute debe ser una imagen.',
            'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
            'exists' => 'El :attribute seleccionado no es válido.',
        ];
        
        // Combinar con mensajes personalizados
        $allMessages = array_merge($defaultMessages, $customMessages);
        
        return $allMessages;
    }
}
