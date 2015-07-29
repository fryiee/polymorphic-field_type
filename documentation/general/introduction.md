# Polymorphic Field Type

*anomaly.field_type.polymorphic*

### A polymorphic relation field type.

The polymorphic field type a clean API to establish polymorphic relations between objects.

### Notes

- This field type is designed to be used by API only.

### Usage

Simply set the related entry in order to associate it.

```
$entry->example = $related;
```

You may also use the relation method that is automatically compiled on the model.

```
$entry->example()->associate($related);
```
