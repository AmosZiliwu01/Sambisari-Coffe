<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('backend.content.feedback.list', compact('feedbacks'));
    }

    public function tambah()
    {
        return view('backend.content.feedback.formTambah');
    }

    public function prosesTambah(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'rating' => 'required|string|min:1|max:5',
        ]);


        try {
            $feedback = new Feedback();
            $feedback->nama = $validatedData['nama'];
            $feedback->content = $validatedData['content'];
            $feedback->rating = str_repeat('⭐️', $validatedData['rating']);

            $feedback->save();
            return redirect(route('feedback.index'))->with('pesan', ['success', 'Feedback berhasil ditambahkan']);
        } catch (\Exception $e) {

            return redirect()->back()->with('pesan', ['error', 'Gagal menambahkan feedback. Silakan coba lagi.']);
        }
    }


    public function hapus($id)
    {
        $feedback = Feedback::findOrFail($id);

        try {
            $feedback->delete();
            return redirect(route('feedback.index'))->with('pesan', ['success','Berhasil hapus feedback']);
        } catch (\Exception $e) {
            return redirect(route('feedback.index'))->with('pesan', ['danger','Gagal hapus feedback']);
        }
    }

//    public function list()
//    {
//        $feedbacks = Feedback::all();
//        return view('backend.content.feedback.list', compact('feedbacks'));
//    }
//
//    public function formTambah()
//    {
//        return view('backend.content.feedback.formTambah');
//    }

}
