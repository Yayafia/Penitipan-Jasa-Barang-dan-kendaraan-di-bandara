

<?php $__env->startSection('title'); ?>
Admin | Deskripsi Entry
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<h3>Input Deskripsi</h3>
<div class="form-login">
  <form action="<?php echo e(route('categories.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <label for="penitip">Nama Penitip</label>
    <input class="input" type="text" name="penitip" id="penitip" placeholder="Nama Penitip" value="<?php echo e(old('penitip')); ?>" required />
    <?php $__errorArgs = ['penitip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p style="font-size: 10px; color: red"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="totalHarga">Total Harga</label>
    <input class="input" type="text" name="totalHarga" id="totalHarga" placeholder="Total Harga" value="<?php echo e(old('totalHarga')); ?>" required />
    <?php $__errorArgs = ['totalHarga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p style="font-size: 10px; color: red"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="categories">Kategori</label>
    <input class="input" type="text" name="categories" id="categories" placeholder="Kategori" value="<?php echo e(old('categories')); ?>" required />
    <?php $__errorArgs = ['categories'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p style="font-size: 10px; color: red"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="keterangan">Keterangan</label>
    <input class="input" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo e(old('keterangan')); ?>" required />
    <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p style="font-size: 10px; color: red"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label for="photo">Foto</label>
    <input type="file" name="gambar" id="photo" />
    <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <p style="font-size: 10px; color: red"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <button type="submit" class="btn btn-simpan" name="simpan" style="margin-top: 50px">
      Simpan
    </button>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\penitipan-jasa-barang\resources\views/categories/categories-entry.blade.php ENDPATH**/ ?>