

<?php $__env->startSection('title'); ?>
Categories | Admin
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<h3>Categories</h3>

<!-- Tambahkan Button Cetak -->
<button type="button" class="btn btn-cetak">
  <a href="<?php echo e(url('/dashboard/cetak')); ?>" target="_blank">Cetak Data</a>
</button>

<!-- Tombol Tambah Data -->
<button type="button" class="btn btn-tambah">
  <a href="/category/tambah">Tambah Data</a>
</button>

<table class="table-data">
  <thead>
    <tr>
        <th scope="col" style="width: 20%">Photo</th>
        <th>Categories</th>
        <th scope="col" style="width: 15%">Price</th>
        <th scope="col" style="width: 30%">Keterangan</th>
        <th scope="col" style="width: 20%">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <tr>
      <td><img src="<?php echo e(asset('img_categories/' . $category->gambar)); ?>" alt="" width="300px"></td>
      <td><?php echo e($category->nama); ?></td>
      <td>Rp. <?php echo e(number_format($category->harga)); ?></td>
      <td><?php echo e($category->deskripsi); ?></td>
      <td>
        <a class='btn-edit' href="/category/edit/<?php echo e($category->id_categories); ?>">Edit</a>
        |
        <a class='btn-delete' href="/category/hapus/<?php echo e($category->id_categories); ?>">Hapus</a>
      </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
      <td colspan="5" align="center">Tidak ada data</td>
    </tr>
    <?php endif; ?>
  </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\penitipan-jasa-barang\resources\views/dashboard/dashboard.blade.php ENDPATH**/ ?>